<?php

namespace App\Http\Controllers\BengkelManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BengkelRegistrationController extends Controller
{
    public function bengkelRegistrationPage() {
        return view( 'features.bengkel-manager.bengkel-registration.main' );
    }
}
