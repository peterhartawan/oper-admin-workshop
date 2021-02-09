<?php

namespace App\Http\Controllers\WaMarketingBlast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromoBlastController extends Controller
{
    public function promoBlastPage() {
        return view( 'features.wa-marketing-blast.promo-blast.main' );
    }
}
