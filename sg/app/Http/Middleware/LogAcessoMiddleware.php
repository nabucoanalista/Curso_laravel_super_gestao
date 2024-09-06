<?php

namespace App\Http\Middleware;

use Closure;
use App\LogAcesso;
use Illuminate\Support\Facades\Log;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //$request - manipulação da requisição
        //return $next($request);

        $ip = $request->server->get('REMOTE_ADDR');
        $rota = $request->getRequestUri();
        LogAcesso::create([
            'log' => "IP $ip requisitou a rota $rota"
        ]);
        return response('Chegamos no middleware e finalizamos no middleware');
    }
}
