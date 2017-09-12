<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eloquent;

class GenreController extends Controller
{
    public function creategenre()
    {
    	return View('genres.create');
    }
}
