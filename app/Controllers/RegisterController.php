<?php


namespace App\Controllers;


use App\Models\User;
use Arcadia\Controller;
use Arcadia\Exceptions\ValidationException;
use Arcadia\Request;

/**
 * Class RegisterController
 * @package App\Controllers
 */
class RegisterController extends Controller
{
    public function __invoke(Request $request) : bool|array|string
    {
        if ($request->isGet()) {
            return $this->show("register");
        }
        
        try {
            $user = new User();
            $user->validate($request, User::registerRules());
            $user->create();
            
            return $this->show("register", [
                "user" => $user->toArray(),
            ]);
            
        } catch (ValidationException $exception) {
            return $this->show("register", [
                "errors" => $exception->getErrors(),
                "old" => $request->inputs(),
            ]);
        }
    }
}
