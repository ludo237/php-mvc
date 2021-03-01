<?php

namespace App\Controllers;

use Arcadia\Controller;

/**
 * Class AboutController
 * @package App\Controllers
 */
class AboutController extends Controller
{
    public function __invoke() : bool|array|string
    {
        return $this->show("about");
    }
}
