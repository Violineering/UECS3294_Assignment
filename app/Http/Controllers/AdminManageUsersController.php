<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class AdminManageUsersController extends Controller
{
    public function showUsers() 
    {
        $users = User::paginate(8);
        return view('admin.manageUsers', ['users' => $users]);
    }
}
