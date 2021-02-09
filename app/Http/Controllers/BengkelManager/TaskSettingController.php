<?php

namespace App\Http\Controllers\BengkelManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskSettingController extends Controller
{
    public function taskSettingPage() {
        return view( 'features.bengkel-manager.task-setting.main' );
    }
}
