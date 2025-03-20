<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminMainPageController extends Controller
{
    public function index()
    {
        return view('admin.mainPage');
    }
}
