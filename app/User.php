<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Providers\User\Illuminate;
use Tymon\JWTAuth\Providers\User\UserInterface;

class User implements UserInterface
{

    private $id;

    /**
     * Get the user by the given key, value.
     *
     * @param string $key
     * @param mixed $value
     * @return User
     */
    public function getBy($key, $value)
    {
        $this->id = $value;
        return $this;
    }
}
