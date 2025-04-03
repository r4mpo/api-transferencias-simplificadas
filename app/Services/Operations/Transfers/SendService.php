<?php

namespace App\Services\Operations\Transfers;

use App\DTO\Default\ResponseDTO;
use App\Helpers\CoinsHelper;
use App\Models\Transfer;
use App\Models\User;
use App\Repositories\TransfersRepository;
use App\Repositories\UsersRepository;
use App\Services\DefaultService;
use App\ValueObjects\Operations\Transfers\SendVO;
use Http;

class SendService extends DefaultService
{
    protected TransfersRepository $transfers_repository;
    protected UsersRepository $users_repository;
    protected Transfer $transfer;
    protected string $not_found_message = 'Houve um erro na execução da transferência.';

    public function __construct(TransfersRepository $transfers_repository, UsersRepository $users_repository)
    {
        parent::__construct();
        $this->transfers_repository = $transfers_repository;
        $this->users_repository = $users_repository;
    }

    public function send($request): ResponseDTO
    {
        try {
            new SendVO($request);


            $request = [
                'sender_id' => $request['payer'],
                'receiver_id' => $request['payee'],
                'value' => $request['value'],
                'status' => Transfer::STATUS_COMPLETE
            ];

            $response_db = null;

            if ($this->authorize($request)) {
                $this->transfer = $this->register_transfer($request);
                $response_db = $this->transfer_processes();
            }

            $response = $this->standardize_response($response_db, $response_db, $this->not_found_message);
            $this->set_response_data($response);
        } catch (\Exception $e) {
            $this->handle_exception($e);
        } finally {
            return $this->response_data($request);
        }
    }

    private function authorize($request): bool
    {
        $sender = $this->find_user($request['sender_id']);
    
        if (!$this->authorize_profile($sender)) {
            $this->not_found_message = 'Apenas usuários com o respectivo perfil podem executar transferências.';
            return false;
        }
    
        if (!$this->authorize_transfer()) {
            $this->not_found_message = 'O serviço externo não autorizou a execução da transferência.';
            return false;
        }
    
        if (!$this->sufficient_balance($sender, $request['value'])) {
            $this->not_found_message = 'Saldo insuficiente para realizar a transferência.';
            return false;
        }
    
        return true;
    }
    
    private function authorize_profile(User $sender): bool
    {
        return $sender->profile == User::USER_PROFILE;
    }
    
    private function sufficient_balance(User $sender, $value): bool
    {
        return $sender->balance >= $value;
    }    

    private function find_user($user_id): User
    {
        return $this->users_repository->find_db($user_id);
    }

    private function authorize_transfer(): bool
    {
        $method = 'get';
        // Em um projeto real, seria interessante colocar no .env
        $url = 'https://util.devi.tools/api/v2/authorize';
        $request = $this->external_services($method, $url);
        return $request['data']['data']['authorization'];
    }

    private function authorize_email(): bool
    {
        $method = 'post';
        // Em um projeto real, seria interessante colocar no .env
        $url = 'https://util.devi.tools/api/v1/notify';
        $request = $this->external_services($method, $url);
        return $request['status'] == 204;
    }

    private function external_services(string $method, string $url, array $data = [], array $headers = []): array
    {
        $defaultHeaders = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        $headers = array_merge($defaultHeaders, $headers);
        $response = Http::withHeaders($headers)->$method($url, $data);

        return [
            'status' => $response->status(),
            'data' => $response->json(),
        ];
    }

    private function register_transfer($request): Transfer
    {
        return $this->transfers_repository->register_db($request);
    }

    private function transfer_processes(): array|null
    {
        $transfer_value = $this->transfer->value;
        $sender = $this->find_user($this->transfer->sender_id);
        $receiver = $this->find_user($this->transfer->receiver_id);

        $balance_current_sender = $sender->balance;
        $balance_current_receiver = $receiver->balance;

        $balance_new_sender = ($balance_current_sender - $transfer_value);
        $balance_new_receiver = ($balance_current_receiver + $transfer_value);

        $this->alter_user($sender, ['balance' => $balance_new_sender]);
        $this->alter_user($receiver, ['balance' => $balance_new_receiver]);

        if ($this->authorize_email()) {
            return $this->format_transfer();
        }

        $this->reverse_transfer($balance_current_sender, $balance_current_receiver);
        return null;
    }

    private function format_transfer(): array
    {
        $transfer = array();
        $transfer['value'] = CoinsHelper::to_brazilian_coin_format($this->transfer->value);
        $transfer['sender'] = $this->find_user($this->transfer->sender_id)->name;
        $transfer['receiver'] = $this->find_user($this->transfer->receiver_id)->name;

        return $transfer;
    }

    private function reverse_transfer($previous_value_sender, $previous_value_receiver): void
    {
        $sender = $this->find_user($this->transfer->sender_id);
        $receiver = $this->find_user($this->transfer->receiver_id);
    
        $this->alter_user($sender, ['balance' => $previous_value_sender]);
        $this->alter_user($receiver, ['balance' => $previous_value_receiver]);
        $this->alter_transfer(['status' => Transfer::STATUS_EMAIL_NOT_SEND]);
    
        $this->not_found_message = 'Erro ao notificar pagamento, transferência estornada.';
    }
    
    private function alter_transfer(array $data): void
    {
        $this->transfers_repository->alter_db($this->transfer, $data);
    }

    private function alter_user(User $user, array $data): void
    {
        $this->users_repository->alter_db($user, $data);
    }
}