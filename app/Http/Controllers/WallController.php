<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WallController extends Controller
{
    public function createwall()
    {
    	return View('walls.create');
    }
}
