<?php

namespace App\Http\Controllers\BengkelManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BengkelSettingController extends Controller
{
    public function bengkelSettingPage() {
        return view( 'features.bengkel-manager.bengkel-setting.main' );
    }
}
