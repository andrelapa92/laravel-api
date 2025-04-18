<?php

use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array
     */
    protected $proxies = '*'; // Aceita todas as conexões externas

    /**
     * The headers that should be used to detect proxies.
     *
     * @var string
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;

    public function handle($request, \Closure $next)
    {
        // Verifica se a aplicação está sendo acessada via HTTP e redireciona para HTTPS
        if (env('APP_ENV') === 'production' && !$request->secure()) {
            return redirect()->secure($request->getRequestUri());
        }

        return parent::handle($request, $next);
    }
}
