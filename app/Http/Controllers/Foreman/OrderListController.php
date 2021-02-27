<?php

namespace App\Http\Controllers\Foreman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\OperOrder;
use App\Model\TaskList;
use App\Model\TaskMaster;
use Illuminate\Support\Facades\Log;

use Session;

class OrderListController extends Controller
{
    public function viewOrderList() {
        return view( 'features.foreman.order-list.main' );
    }

    public function updateOrderList(Request $request) {
        try {
            $order = OperOrder::find($request->id);
            if ($order->order_status == 3) {
                $order->update([
                    "order_status" => 4
                ]);
            } else if($order->order_status == 4) {
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

    public function paginateOrderList(Request $request) {
        $filter = [];

        if( !empty($request->value) )
            array_push($filter, [$request->key, "LIKE", "%{$request->value}%"]);

        $response = OperOrder::where( $filter )
                        ->whereIn("order_status", [3,4])
                        ->with(['workshopBengkel:id,bengkel_name'])
                        ->paginate( $request->get( 'size' ) )
                        ->toJson();
            
        return view( 'features.foreman.order-list.function.table')
            ->with( 'listdata', json_decode($response, false) );
    }

    public function detailOrderList($id) {
        $response = OperOrder::with([
                            'workshopBengkel:id,bengkel_name',
                            'vehicleBrand',
                            'vehicleType'
                        ])
                        ->find($id);
        
        return response()->json( $response );
    }

    public function tableTaskList($id) {
        $response = OperOrder::find($id);
        $response = TaskList::where('master_task_id', $response->master_task)
                        ->with('masterTask')
                        ->get()
                        ->sortBy('list_sequence')
                        ->toJson();
            
        return view( 'features.foreman.order-list.function.table-status-4')
            ->with( 'listdata', json_decode($response, false) );
    }

    public function updateTaskList(Request $request) {
        try {
            $response = TaskList::find($request->listID);
            $response->list_done = new \DateTime('now');
            $response->save();

            $check = TaskList::where("master_task_id", $response->master_task_id)
                        ->whereNull("list_done")
                        ->count();

            if ($check == 0) {
                OperOrder::find($request->id)->update([
                    "order_status" => 5
                ]);
            }
            
            Session::flash('success', 'Success to update task list timestamp');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Update Task List Timestamp error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }
}
