<?php


namespace App\Controllers;


use Arcadia\Controller;
use Arcadia\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request) : bool|array|string
    {
        if ($request->isGet()) {
            return $this->show("login");
        }
        
        return "Login";
    }
}
