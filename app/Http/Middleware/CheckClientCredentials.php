<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Passport\Exceptions\AuthenticationException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Component\HttpFoundation\Response;

class CheckClientCredentials
{

    public function handle($request, Closure $next, ...$scopes): Response
    {
        // check Client Credential


    }
}
