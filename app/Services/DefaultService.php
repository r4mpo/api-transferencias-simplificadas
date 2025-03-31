<?php

namespace App\Services;

use App\DTO\Default\ResponseDTO;
use App\Helpers\LoggingHelper;
use App\Helpers\ValidadorCodigoStatusHttp;

abstract class DefaultService
{
    protected ResponseDTO $resposta_dto;

    public function __construct()
    {
        $this->resposta_dto = new ResponseDTO();
    }

    protected function montar_resposta(mixed $dados, mixed $mensagem_personalizada = null, string $mensagem_nao_encontrada): \stdClass
    {
        $resposta = new \stdClass();
        $resposta->codigo_status = $dados ? (request()->method() === "POST" ? 201 : 200) : 404;
        $resposta->codigo_retorno = $dados ? 111 : 333;
        $resposta->mensagem = $dados ? ($mensagem_personalizada ?? 'Sucesso na operação.') : $mensagem_nao_encontrada;

        return $resposta;
    }

    protected function definir_dados_resposta(\stdClass $resposta): void
    {
        $this->resposta_dto->set_retorno($resposta->mensagem);
        $this->resposta_dto->set_codigo_retorno($resposta->codigo_retorno);
        $this->resposta_dto->set_status_code($resposta->codigo_status);
    }

    protected function lidar_com_excecao(\Exception $e): void
    {
        $codigo_status = ValidadorCodigoStatusHttp::e_codigo_status_http_valido($e->getCode() ?: 422);
        $erros = $codigo_status === 422 ? explode(',', $e->getMessage()) : "Erro ao processar a requisição";

        $this->resposta_dto->set_retorno($erros);
        $this->resposta_dto->set_codigo_retorno(333);
        $this->resposta_dto->set_status_code($codigo_status);
    }

    protected function dados_resposta(array $requisicao): ResponseDTO
    {
        LoggingHelper::log_geral($requisicao, $this->resposta_dto);
        return $this->resposta_dto;
    }
}