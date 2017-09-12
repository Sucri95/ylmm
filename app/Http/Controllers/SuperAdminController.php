<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function createsuperadmin()
    {
    	return View('users.create_superadmin');
    }
}
