<?php

namespace App\Http\Controllers\BengkelManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BengkelSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;

class BengkelSettingController extends Controller
{
    public function viewBengkelSetting() {
        return view( 'features.bengkel-manager.bengkel-setting.main' );
    }

    public function updateBengkelSetting(Request $request) {
        try {
            $bengkel = BengkelSetting::find($request->id);
            $bengkel->bengkel_open = $request->open;
            $bengkel->bengkel_close = $request->close;
            $bengkel->min_daily = $request->order;
            $bengkel->min_order_time = $request->ordertime;
            $bengkel->maks_jarak = $request->distance;
            $bengkel->last_update = new \DateTime('now');
            $bengkel->save();

            Session::flash('success', 'Success to update user');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Update User Manager error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function paginateBengkelSetting(Request $request) {
        $filter = [];

        if( !empty($request->value) )
            array_push($filter, [$request->key, "LIKE", "%{$request->value}%"]);

        $response = DB::table('bengkel_settings')
            ->join('workshop_bengkels', 'bengkel_settings.workshop_bengkel_id', '=', 'workshop_bengkels.id')
            ->select('bengkel_settings.*', 'workshop_bengkels.bengkel_name')
            ->where($filter)
            ->orderBy('workshop_bengkels.bengkel_name')
            ->paginate( $request->get( 'size' ) )
            ->toJson();

        return view( 'features.bengkel-manager.bengkel-setting.function.table')
            ->with( 'listdata', json_decode($response, false) );
    }

    public function detailBengkelSetting($id) {
        $response = BengkelSetting::with('workshopBengkel:id,bengkel_name')
                        ->find($id);

        return response()->json( $response );
    }
}
