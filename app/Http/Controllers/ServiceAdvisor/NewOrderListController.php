<?php

namespace App\Http\Controllers\ServiceAdvisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\OperOrder;
use Illuminate\Support\Facades\Log;

use Session;

class NewOrderListController extends Controller
{
    public function viewNewOrderList() {
        return view( 'features.service-advisor.new-order-list.main' );
    }

    public function updateStatusNewOrderList(Request $request) {
        try {
            OperOrder::find($request->id)->update([
                "order_status" => 2
            ]);
            
            Session::flash('success', 'Success to update status order');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Update Status Order error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function paginateNewOrderList(Request $request) {
        $filter = [
            [ 'order_status', 1 ],
        ];

        if( !empty($request->value) )
            array_push($filter, [$request->key, "LIKE", "%{$request->value}%"]);

        $response = OperOrder::where( $filter )
                ->with(['workshopBengkel:id,bengkel_name'])
            ->paginate( $request->get( 'size' ) )
            ->toJson();
            
        return view( 'features.service-advisor.new-order-list.function.table')
            ->with( 'listdata', json_decode($response, false) );
    }

    public function detailNewOrderList($id) {
        $response = OperOrder::with([
                            'workshopBengkel:id,bengkel_name',
                            'vehicleBrand',
                            'vehicleType'
                        ])
                        ->find($id);
        
        return response()->json( $response );
    }
}
