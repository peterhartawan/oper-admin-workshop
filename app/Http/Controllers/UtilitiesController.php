<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilitiesController extends Controller
{
    public function download(Request $request) {
        $array_string = explode('/', $request->file);
        return response()->download(public_path().'/'.$request->file, $array_string[2]);
    }
}
