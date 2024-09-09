<?php

namespace App\Http\Middleware;

use Closure;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $metodo_autenticacao, $perfil)
    {
        //verificar se o usuário está autenticado
        echo $metodo_autenticacao .' - '.$perfil.'<br>';

        if($metodo_autenticacao == 'padrao'){
            echo 'Verificar o usuário e senha no banco de dados'.$perfil.'<br>';
        }

        if($metodo_autenticacao == 'ldap'){
            echo 'Verificar o usuário e senha no AD'.$perfil.'<br>';
        }

        if($perfil == 'visitante'){
            echo 'Perfil de visitante';
        } else {
            echo 'carregar as permissões do banco de dados';
        }

        if(false){ // dessa forma, qualquer usuário está autenticado pois o if sempre será verdadeiro.
            return $next($request);
        } else { // se o usuário não estiver autenticado, retornar um erro 401
            return response('Acesso negado! Rota exige autenticação.', 401);
        }

    }
}
