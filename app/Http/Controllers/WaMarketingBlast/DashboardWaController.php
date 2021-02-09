<?php

namespace App\Http\Controllers\WaMarketingBlast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardWaController extends Controller
{
    public function dashboardWaPage() {
        return view( 'features.wa-marketing-blast.dashboard-wa.main' );
    }
}
