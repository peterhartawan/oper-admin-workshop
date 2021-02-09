<?php

namespace App\Http\Controllers\ServiceAdvisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewOrderListController extends Controller
{
    public function newOrderListPage() {
        return view( 'features.service-advisor.new-order-list.main' );
    }
}
