<?php


namespace App\Controllers;


use Arcadia\Controller;
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
        
        return "Register data";
    }
}
