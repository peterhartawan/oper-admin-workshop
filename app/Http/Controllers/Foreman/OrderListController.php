<?php

namespace App\Http\Controllers\Foreman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BengkelSetting;
use Illuminate\Support\Facades\Log;

use Session;

class OrderListController extends Controller
{
    public function viewOrderList() {
        return view( 'features.foreman.order-list.main' );
    }

    public function updateOrderList(Request $request) {
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

    public function paginateOrderList(Request $request) {
        $filter = [];

        if( !empty($request->value) )
            array_push($filter, [$request->key, "LIKE", "%{$request->value}%"]);

        $response = BengkelSetting::whereHas( "workshopBengkel", function($query) use ($filter) {
                $query->where( $filter );
            })
            ->with(['workshopBengkel:id,bengkel_name'])
            ->paginate( $request->get( 'size' ) )
            ->toJson();
        
        $response = '{[]}';
            
        return view( 'features.foreman.order-list.function.table')
            ->with( 'listdata', json_decode($response, false) );
    }

    public function detailOrderList($id) {
        $response = BengkelSetting::with('workshopBengkel:id,bengkel_name')
                        ->find($id);
        
        return response()->json( $response );
    }
}
