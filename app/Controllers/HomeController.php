<?php

namespace App\Controllers;

use Arcadia\Controller;

/**
 * Class HomeController
 * @package App\Controllers
 */
class HomeController extends Controller
{
    public function __invoke() : bool|array|string
    {
        $viewParameter = [
            "name" => "Foo Bar",
        ];
    
        return $this->show("home", $viewParameter);
    }
}
