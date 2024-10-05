<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavbarController extends Controller
{
    public function navbar()
    {
        return view('navbar');
    }
}
