<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function createwinner()
    {
    	return View('winners.create');
    }
}
