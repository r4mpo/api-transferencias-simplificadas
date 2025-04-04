<?php

namespace App\Services\Operations\Stratuns;

use App\DTO\Default\ResponseDTO;
use App\Helpers\CoinsHelper;
use App\Repositories\TransfersRepository;
use App\Services\DefaultService;

class FindService extends DefaultService
{
    protected TransfersRepository $transfers_repository;

    protected string $not_found_message = 'Houve um erro na localização do estrato.';

    public function __construct(TransfersRepository $transfers_repository)
    {
        parent::__construct();
        $this->transfers_repository = $transfers_repository;
    }

    public function find(): ResponseDTO
    {
        try {
            $transfers = $this->find_db();
            $response_db = empty($transfers) ? 'Não há nenhuma transferência cadastrada.' : $this->format_transfers($transfers);
            $response = $this->standardize_response($response_db, $response_db, $this->not_found_message);
            $this->set_response_data($response);
        } catch (\Exception $e) {
            $this->handle_exception($e);
        } finally {
            return $this->response_data([]);
        }
    }

    private function find_db(): array
    {
        return $this->transfers_repository->related_transfers(auth()->id());
    }

    private function format_transfers($transfers): array
    {
        $prepare = array();

        foreach ($transfers as $transfer) {
            $index = strtolower($transfer->type);

            $formated = array();
            $formated['value'] = CoinsHelper::to_brazilian_coin_format($transfer->value);
            $formated['sender'] = $transfer->sender_name;
            $formated['receiver'] = $transfer->receiver_name;
            $formated['status'] = $transfer->status;

            $prepare[$index][] = $formated;
        }


        return $prepare;
    }
}