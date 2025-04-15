<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class AdminManageAdminController extends Controller
{
    public function showAdmin() 
    {
        $users = User::where('role', 'admin') -> paginate(8);
        return view('admin.manageAdmin', ['users' => $users]);
    }

}
