<?php
/**
 * Created by PhpStorm.
 * User: Antonio Arciniega
 * Date: 10/03/2018
 * Time: 0:30
 */

namespace App\Providers;


use GuzzleHttp\Client;
use Lcobucci\JWT\Signer\Key;
use Cache;
use Log;

class RsaPublicKeyProvider
{

    const CACHED_PERIOD = 1440; // 24 hours

    static function get(){
        Log::debug('** Retrieving RSA PKey....');

        return Cache::remember('jwt-key-signature', self::CACHED_PERIOD , function () {
            Log::debug('From IAM Services');
            return new Key(
                (new Client())->request('GET', config('jwt.token-provider.pkey-url'))
                    ->getBody()
                    ->getContents()
            );
        });
    }
}