<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use http\Env\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }


    public function updateProfile(Request $request)
    {

    }
}
