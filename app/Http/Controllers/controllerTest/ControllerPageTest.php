<?php

namespace App\Http\Controllers\controllerTest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ControllerPageTest extends Controller
{
    public function test01()
    {
        return view('testpage.home');
    }
}
