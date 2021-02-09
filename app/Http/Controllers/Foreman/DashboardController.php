<?php

namespace App\Http\Controllers\Foreman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardPage() {
        return view( 'features.foreman.dashboard.main' );
    }
}
