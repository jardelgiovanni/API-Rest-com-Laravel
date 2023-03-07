<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;

trait ApiHandler
{
    /**
     * Trata os erros personalizados
     *
     * @param Throwable $exception
     * @return Response
     */
    public function tratarErros(Throwable $exception): Response | false
    {
        if ($exception instanceof ModelNotFoundException) {
            return $this->modelNotFoundException();
        }

        if ($exception instanceof ValidationException) {
            return $this->validationException($exception);
        }

        return false;
    }

    /**
     * Retorna o erro quando não encontrado o registro
     *
     * @return Response
     */
    public function modelNotFoundException(): Response
    {
        return $this->respostaPadrao(
            "registro-nao-encontrado",
            "O sistema não encontrou o registro solicitado",
            404
        );
    }

    /**
     * Retorna o erro quando os dados não são válidos
     *
     * @param ValidationException $e
     * @return Response
     */
    public function validationException(ValidationException $e): Response
    {
        return $this->respostaPadrao(
            "erro-validacao",
            "Os dados enviados são inválidos",
            400,
            $e->errors()
        );
    }

    /**
     * Retorna uma resposta padrão para os erros da API
     *
     * @param string $code
     * @param string $mensagem
     * @param integer $status
     * @param array|null $erros
     * @return Response
     */
    public function respostaPadrao(string $code, string $mensagem, int $status, array $erros = null): Response
    {
        $dadosResposta = [
            "code" => $code,
            "message" => $mensagem,
            "status" => $status
        ];

        if ($erros) {
            $dadosResposta = $dadosResposta + ["erros" => $erros];
        }

        return response(
            $dadosResposta,
            $status
        );
    }
}
