<?php


namespace App\Controllers;


use App\Models\User;
use Arcadia\Auth;
use Arcadia\Controller;
use Arcadia\Exceptions\ValidationException;
use Arcadia\Request;
use Arcadia\Response;

class LoginController extends Controller
{
    public function __invoke(Request $request, Response $response) : bool|array|string
    {
        if ($request->isGet()) {
            return $this->show("login");
        }
        
        try {
            $user = new User();
            $user->validate($request, User::loginRules());
            
            $user = $user->first(["email" => $request->input("email")]);
            
            (new Auth)->login($user);
            
            $response->redirect("/");
        } catch (ValidationException $exception) {
            return $this->show("login", [
                "errors" => $exception->getErrors(),
                "old" => $request->inputs(),
            ]);
        }
    }
}
