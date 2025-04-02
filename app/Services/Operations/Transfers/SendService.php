<?php

namespace App\Services\Operations\Transfers;

use App\DTO\Default\ResponseDTO;
use App\Repositories\TransfersRepository;
use App\Services\DefaultService;
use App\ValueObjects\Operations\Transfers\SendVO;

class SendService extends DefaultService
{
    protected TransfersRepository $transfers_repository;
    protected string $not_found_message = 'Houve um erro na execução da transferência.';

    public function __construct(TransfersRepository $transfers_repository)
    {
        parent::__construct();
        $this->transfers_repository = $transfers_repository;
    }

    public function send($request): ResponseDTO
    {
        try {
            new SendVO($request);
            $response_db = $this->transfers_repository->register_db($request);
            $response = $this->standardize_response($response_db, $response_db, $this->not_found_message);
            $this->set_response_data($response);
        } catch (\Exception $e) {
            $this->handle_exception($e);
        } finally {
            return $this->response_data($request);
        }
    }
}