# Laravel JWT Microservice

This is an example project to use Laravel framework as microservice with JWT auth.

NOTE: The purpose of this, is only speed-up coding to implement private Laravel microservices with external Identity Provider.

## Getting user from request

```
class SendNotificationsController extends Controller
{
    public function send(Request $request){
    
        $user = $request->user(); // Get AuthUser instance from request
        
        $user_id = $user->id; // Get user id 
        $user_email = $user->id; // Get user email


    }
}
```


## AuthUser Class

```
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
```

## JWT Signatures

By default, the project uses RS256 as algorythm to verify tokens and retrives the public key from external service. 

You can change the url in [jwt.php]() config file:
```
'token-provider' => [
        'pkey-url' => env('ISSUER_PKEY_URL')
    ]
```

## Docker
Project includes [Dockerfile]() and [docker-compose.yml]() to run locally using Docker.


## Contributing

Feel free to change all you want!

## References
* [Laravel Documentation](https://laravel.com/docs)
* [lcobucci/jwt](https://github.com/lcobucci/jwt)
* [tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth)