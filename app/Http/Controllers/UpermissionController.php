<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpermissionController extends Controller
{
    public function createupermission()
    {
    	return View('upermissions.create');
    }
}
