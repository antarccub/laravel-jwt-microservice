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

    private $token;

    public $email;
    public $id;

    /*
     * Here you can add your custom claims
     */

    public function __construct()
    {
        $this->token = (new Parser())->parse(JWTAuth::getToken()->get());

        $this->id = self::getClaim("sub");
        $this->email = self::getClaim("email");
    }

    private function getClaim($name){

        return $this->token->getClaim($name);

    }

}