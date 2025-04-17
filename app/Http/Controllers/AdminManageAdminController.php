<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class AdminManageAdminController extends Controller
{
    public function showAdmin()
{
    $user = auth()->user(); // Get the currently logged-in user

    // OPTIONAL: make sure they are admin
    if ($user->role !== 'admin') {
        abort(403, 'Unauthorized access.');
    }

    return view('admin.manageAdmin', ['users' => $user]);

}


}
