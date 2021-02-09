<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerListController extends Controller
{
    public function customerListPage() {
        return view( 'features.user-management.customer-list.main' );
    }
}
