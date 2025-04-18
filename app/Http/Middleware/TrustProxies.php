<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string
     */
    protected $proxies = '*'; // Pode ser configurado de acordo com a sua necessidade

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = SymfonyRequest::HEADER_X_FORWARDED_ALL;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        // Verifica se é produção e redireciona para HTTPS
        if (env('APP_ENV') === 'production' && !$request->secure()) {
            return redirect()->secure($request->getRequestUri());
        }

        return parent::handle($request, $next);
    }
}
