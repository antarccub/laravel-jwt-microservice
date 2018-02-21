<?php
/**
 * Created by PhpStorm.
 * User: Antonio Arciniega
 * Date: 21/02/2018
 * Time: 0:28
 */

namespace App;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notifiable;
use JWTAuth;
use Lcobucci\JWT\Parser;

class AuthUser
{

    use Notifiable;

    private $token;

    protected $email;
    protected $id;

    public function __construct()
    {
        $this->token = (new Parser())->parse(JWTAuth::getToken()->get());

        $this->id = self::getClaim("sub");
        $this->email = self::getClaim("email");
    }

    private function getClaim($name){

        return $this->token->getClaim($name);

    }

    public function routeNotificationForMail()
    {
        return $this->email;
    }
}