<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('author.dashboard');
    }
}
