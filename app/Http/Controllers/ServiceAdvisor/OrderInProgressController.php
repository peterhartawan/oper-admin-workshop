<?php

namespace App\Http\Controllers\ServiceAdvisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\OperOrder;
use Illuminate\Support\Facades\Log;

use Session;

class OrderInProgressController extends Controller
{
    public function viewOrderInProgress() {
        return view( 'features.service-advisor.order-inprogress.main' );
    }

    public function updateOrderInProgress(Request $request) {
        try {
            $order = OperOrder::find($request->id);
            if ($order->order_status == 2) {
                $order->update([
                    "pkb_file" => 
                        env('APP_URL').'/download?file=files/pkb/'.$request->file('file')->getClientOriginalName(),
                    "order_status" => 3
                ]);

                $request->file( "file" )->move(
                    public_path('files/pkb'),
                    $request->file( "file" )->getClientOriginalName()
                );
            } else if($order->order_status == 5) {
                $order->update([
                    "order_status" => 6
                ]);
            }
            
            Session::flash('success', 'Success to update status order');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Update Status Order error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function paginateOrderInProgress(Request $request) {
        $filter = [
            [ "service_advisor_id", Session::get("user")->id]
        ];

        if( !empty($request->value) )
            array_push($filter, [$request->key, "LIKE", "%{$request->value}%"]);

        $response = OperOrder::where( $filter )
                        ->whereIn("order_status", [2, 5])
                        ->with(['workshopBengkel:id,bengkel_name'])
                        ->paginate( $request->get( 'size' ) )
                        ->toJson();
            
        return view( 'features.service-advisor.order-inprogress.function.table')
            ->with( 'listdata', json_decode($response, false) );
    }

    public function detailOrderInProgress($id) {
        $response = OperOrder::with([
                            'workshopBengkel:id,bengkel_name',
                            'vehicleBrand',
                            'vehicleType'
                        ])
                        ->find($id);
        
        return response()->json( $response );
    }
}
