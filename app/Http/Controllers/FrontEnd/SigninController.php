<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SigninController extends Controller
{
    public function index()
    {
        return view('auth.signin');
    }

    public function signup()
    {
        return view('auth.signin');
    }
}
