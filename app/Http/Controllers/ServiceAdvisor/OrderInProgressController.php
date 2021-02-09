<?php

namespace App\Http\Controllers\ServiceAdvisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderInProgressController extends Controller
{
    public function orderInProgressPage() {
        return view( 'features.service-advisor.order-inprogress.main' );
    }
}
