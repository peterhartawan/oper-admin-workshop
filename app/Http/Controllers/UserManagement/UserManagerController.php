<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Session;

class UserManagerController extends Controller
{
    public function userManagerPage() {
        return view( 'features.user-management.user-manager.main' );
    }
}