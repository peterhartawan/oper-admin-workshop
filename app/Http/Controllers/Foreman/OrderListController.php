<?php

namespace App\Http\Controllers\Foreman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    public function orderListPage() {
        return view( 'features.foreman.order-list.main' );
    }
}
