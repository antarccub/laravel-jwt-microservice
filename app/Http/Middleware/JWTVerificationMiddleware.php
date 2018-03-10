<?php

namespace App\Http\Middleware;

use App\AuthUser;
use App\Providers\RsaPublicKeyProvider;
use Carbon\Carbon;
use Closure;


use HttpRequest;
use Illuminate\Http\Request;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\ValidationData;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JWTVerificationMiddleware
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

        $currentTimestamp = Carbon::now();

        // Checks if token valid
        try{
            $token = (new Parser())->parse((string) $request->bearerToken()); // Parses from a string

        }catch (\Exception $exception){
            throw new TokenInvalidException();
        }

        // Verify token signature
        if(!$token->verify(new Sha256(), RsaPublicKeyProvider::get())){
            throw new TokenInvalidException();
        }

        // Checks if expired
        if($token->isExpired($currentTimestamp)){
            throw new TokenExpiredException();
        }


        $request->setUserResolver(function (){
            return new AuthUser();
        });


        return $next($request);

    }

}
