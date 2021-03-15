<?php

namespace App\Controllers;

use Arcadia\Controller;
use Arcadia\Request;

/**
 * Class HomeController
 * @package App\Controllers
 */
class HomeController extends Controller
{
    public function __invoke(Request $request) : bool|array|string
    {
        $viewParameter = [
            "name" => $request->input("name"),
        ];
        
        return $this->show("home", $viewParameter);
    }
}
