<?php

namespace App\Services;

use App\DTO\Default\ResponseDTO;
use App\Helpers\LoggingHelper;
use App\Helpers\HttpStatusCodeValidator;

abstract class DefaultService
{
    protected ResponseDTO $response_dto;

    public function __construct()
    {
        $this->response_dto = new ResponseDTO();
    }

    protected function standardize_response(mixed $data, mixed $message_personalized = null, string $not_found_message): \stdClass
    {
        $response = new \stdClass();
        $response->status_code = $data ? (request()->method() === "POST" ? 201 : 200) : 404;
        $response->return_code = $data ? 111 : 333;
        $response->message = $data ? ($message_personalized ?? 'Sucesso na operação.') : $not_found_message;

        return $response;
    }

    protected function set_response_data(\stdClass $response): void
    {
        $this->response_dto->set_return($response->message);
        $this->response_dto->set_return_code($response->return_code);
        $this->response_dto->set_status_code($response->status_code);
    }

    protected function handle_exception(\Exception $e): void
    {
        $status_code = HttpStatusCodeValidator::is_http_status_code_valid($e->getCode() ?: 422);
        $erros = $status_code === 422 ? explode(',', $e->getMessage()) : "Erro ao processar a requisição";

        $this->response_dto->set_return($erros);
        $this->response_dto->set_return_code(333);
        $this->response_dto->set_status_code($status_code);
    }

    protected function response_data(array $request): ResponseDTO
    {
        LoggingHelper::general_log($request, $this->response_dto);
        return $this->response_dto;
    }
}