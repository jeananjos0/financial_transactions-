<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Middleware para verificar se o usuário é um administrador.
 */
class AuthMiddleware
{
    /**
     * Manipula uma solicitação de entrada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Tenta autenticar o usuário com o token JWT fornecido
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, manipula a exceção e retorna uma resposta JSON apropriada
            return $this->handleException($e);
        }

        // Obtém o usuário autenticado
        $auth_user = auth('api')->user();

        // Verifica se o usuário está ativo, se não, retorna uma resposta JSON com um erro
        if ($auth_user->active != 1) {
            return response()->json(['error' => 'Usuário Desativado!'], Response::HTTP_NOT_FOUND);
        }

        // Se tudo estiver ok, prossegue para o próximo middleware ou controlador
        return $next($request);
    }

    /**
     * Manipula exceções específicas do JWTAuth.
     *
     * @param  \Exception  $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function handleException(\Exception $e)
    {
        // Verifica se a exceção é do tipo TokenInvalidException
        if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
            // Retorna uma resposta JSON com a mensagem de erro e o código de status HTTP 401 (Não Autorizado)
            return response()->json(['error' => 'Token inválido!'], Response::HTTP_UNAUTHORIZED);
        }
        // Verifica se a exceção é do tipo TokenExpiredException
        elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            // Retorna uma resposta JSON com a mensagem de erro e o código de status HTTP 401 (Não Autorizado)
            return response()->json(['error' => 'Token expirado!'], Response::HTTP_UNAUTHORIZED);
        }
        // Caso contrário, trata-se de uma exceção genérica
        else {
            // Retorna uma resposta JSON com a mensagem de erro e o código de status HTTP 403 (Proibido)
            return response()->json(['error' => 'Token não encontrado!'], Response::HTTP_FORBIDDEN);
        }
    }
}
