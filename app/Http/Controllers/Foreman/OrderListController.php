<?php

namespace App\Http\Controllers\Foreman;

use App\Http\Controllers\Controller;
use App\Model\ForemanTaskProgress;
use Illuminate\Http\Request;
use App\Model\OperOrder;
use App\Model\TaskList;
use App\Model\TaskMaster;
use Illuminate\Support\Facades\Log;

use Session;

class OrderListController extends Controller
{
    public function viewOrderList(Request $request) {
        return view( 'features.foreman.order-list.main' )
            ->with( 'confirmed', ($request->page == 'confirmed') ? true :false );
    }

    public function updateOrderList(Request $request) {
        try {
            $order = OperOrder::find($request->id);
            $order->update([
                "order_status" => 4,
                "foreman_id" => Session::get("user")->id
            ]);

            $lists = TaskList
                        ::where('master_task_id', $order->master_task)
                        ->orderBy('list_sequence')
                        ->get()
                        ->toJson();

            foreach (json_decode($lists, false) as $list) {
                ForemanTaskProgress::insert([
                    "order_id" => $request->id,
                    "task_id" => $list->id,
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

    public function paginateOrderListPending(Request $request) {
        $filter = [];

        if( !empty($request->value) )
            array_push($filter, [$request->key, "LIKE", "%{$request->value}%"]);

        $response = OperOrder::where( $filter )
                        ->whereIn("order_status", [3])
                        ->with(['workshopBengkel:id,bengkel_name'])
                        ->paginate( $request->get( 'size' ) )
                        ->toJson();
            
        return view( 'features.foreman.order-list.function.table')
            ->with( 'listdata', json_decode($response, false) );
    }

    public function paginateOrderListConfirmed(Request $request) {
        $filter = [
            [ "foreman_id", Session::get("user")->id]
        ];

        if( !empty($request->value) )
            array_push($filter, [$request->key, "LIKE", "%{$request->value}%"]);

        $response = OperOrder::where( $filter )
                        ->whereIn("order_status", [4])
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
                        ->with( ['masterTask', 'taskProgress'] )
                        ->get()
                        ->sortBy('list_sequence')
                        ->toJson();
            
        return view( 'features.foreman.order-list.function.table-status-4')
            ->with( 'listdata', json_decode($response, false) );
    }

    public function updateTaskList(Request $request) {
        try {
            $response = ForemanTaskProgress::find($request->progressID);
            $response->list_done = new \DateTime('now');
            if($request->hasFile('image')) {

                /**
                 * Hashing picture name
                 */
                $image_name = 
                    md5($request->file('image')->getClientOriginalName().time())
                    .'.'.$request->file('image')->getClientOriginalExtension();

                $response->image_name = 
                    env('APP_URL')
                    .'/download?file=files/task/'
                    .$image_name;

                $request->file( "image" )->move(
                    public_path('files/task'),
                    $image_name
                );
            }
            $response->save();

            $list = TaskList::whereHas("taskProgress", function($query) use ($request) {
                            $query->where('id', $request->progressID);
                        })->first();
            $check = ForemanTaskProgress::whereHas("task", function($query) use ($list) {
                            $query->where("master_task_id", $list->master_task_id);
                        })->whereNull("list_done")
                        ->count();

            if ($check == 0 && $list->as_final_task) {
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
