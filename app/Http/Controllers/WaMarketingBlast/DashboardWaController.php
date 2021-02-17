<?php

namespace App\Http\Controllers\WaMarketingBlast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\WaPromo;
use App\Model\PromoLog;

class DashboardWaController extends Controller
{
    public function viewDashboardWa() {
        $promos = WaPromo::count();;
        $logs = PromoLog::count();
        return view( 'features.wa-marketing-blast.dashboard-wa.main' )
            ->with( 'logs', $logs )
            ->with( 'promos', $promos );
    }
}
