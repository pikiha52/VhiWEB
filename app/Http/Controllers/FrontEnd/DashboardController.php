<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function detail($id)
    {
        return view('dashboard.detail', compact('id'));
    }
}
