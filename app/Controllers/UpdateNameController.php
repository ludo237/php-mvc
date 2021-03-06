<?php

namespace App\Controllers;

use Arcadia\Controller;
use Arcadia\Request;

/**
 * Class UpdateNameController
 * @package App\Controllers
 */
class UpdateNameController extends Controller
{
    public function __invoke(Request $request) : bool|array|string
    {
        return $this->show("home", [
            "name" => $request->input("name"),
        ]);
    }
}
