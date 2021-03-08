<?php

namespace App\Http\Controllers\BengkelManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TaskMaster;
use App\Model\TaskList;
use App\Model\WorkshopBengkel;
use Illuminate\Support\Facades\Log;

use Session;

class TaskSettingController extends Controller
{
    /* MASTER TASK */
        public function viewTaskSetting() {
            $workshops = WorkshopBengkel::doesntHave('masterTask')
                            ->select( ['id', 'bengkel_name'] )
                            ->get()->toJson();

            return view( 'features.bengkel-manager.task-setting.task-master.main' )
                ->with( 'workshops', json_decode($workshops, false) );
        }

        public function createTaskSetting(Request $request) {
            try {
                $task = new TaskMaster();
                $task->task_name = $request->name;
                $task->created_at = new \DateTime('now');
                $task->save();

                WorkshopBengkel::find($request->workshop)->update([
                    "task_id" => $task->id
                ]);
                
                Session::flash('success', 'Success to create master task');
                return back();
            } catch (\Throwable $th) {
                Log::debug('Create Master Task error: '.$th);
                Session::flash('error', 'Something went wrong. Please contact system administrator.');
                return back();
            }
        }

        public function updateTaskSetting(Request $request) {
            try {
                WorkshopBengkel::find($request->workshop)->update([
                    "task_id" => $request->id
                ]);

                $user = TaskMaster::find($request->id);
                $user->task_name = $request->name;
                $user->save();

                WorkshopBengkel::where([['task_id', $request->id], ['id', '!=', $request->workshop]])
                    ->update([
                        "task_id" => null
                    ]);
                
                Session::flash('success', 'Success to update master task');
                return back();
            } catch (\Throwable $th) {
                Log::debug('Update master Task error: '.$th);
                Session::flash('error', 'Something went wrong. Please contact system administrator.');
                return back();
            }
        }

        public function deleteTaskSetting(Request $request) {
            try {
                $user = TaskMaster::find($request->id)->delete();

                Session::flash('success', 'Success to delete master task');
                return back();
            } catch (\Throwable $th) {
                Log::debug('Delete Master Task error: '.$th);
                Session::flash('error', 'Something went wrong. Please contact system administrator.');
                return back();
            }
        }

        public function paginateTaskSetting(Request $request) {
            $filter = [];

            if( !empty($request->value) )
                array_push($filter, [$request->key, "LIKE", "%{$request->value}%"]);

            $response = TaskMaster::where( $filter )
                ->with('workshopBengkel')
                ->paginate( $request->get( 'size' ) )
                ->toJson();
                
            return view( 'features.bengkel-manager.task-setting.task-master.function.table')
                ->with( 'listdata', json_decode($response, false) );
        }

        public function detailTaskSetting($id) {
            $response = TaskMaster::with( ['workshopBengkel'] )->find($id);
            
            return response()->json( $response );
        }

        public function viewDetailTaskMaster(Request $request) {
            $master = TaskMaster::with('workshopBengkel')
                        ->find($request->id)
                        ->toJson();
            
            return view( 'features.bengkel-manager.task-setting.task-list.main' )
                ->with( 'master', json_decode($master, false) )
                ->with( 'id', $request->id );
        }
    /* END MASTER TASK */

    /* TASK LIST */
        public function createTaskList(Request $request) {
            try {
                $max_sequence = TaskList::where("master_task_id", $request->id)
                                ->max("list_sequence");
                
                if($max_sequence == null) {
                    $max_sequence = 1;
                } else {
                    $max_sequence += 1;
                }

                TaskList::insert([
                    "list_name" => $request->name,
                    "master_task_id" => $request->master,
                    "as_final_task" => $request->final,
                    "list_sequence" => $max_sequence
                ]);
                
                Session::flash('success', 'Success to create task list');
                return back();
            } catch (\Throwable $th) {
                Log::debug('Create Task List error: '.$th);
                Session::flash('error', 'Something went wrong. Please contact system administrator.');
                return back();
            }
        }

        public function updateTaskList(Request $request) {
            try {
                $user = TaskList::find($request->id);
                $user->list_name = $request->name;
                $user->list_sequence = $request->sequence;
                $user->save();
                
                Session::flash('success', 'Success to update task list');
                return back();
            } catch (\Throwable $th) {
                Log::debug('Update task List error: '.$th);
                Session::flash('error', 'Something went wrong. Please contact system administrator.');
                return back();
            }
        }

        public function deleteTaskList(Request $request) {
            try {
                $user = TaskList::find($request->id)->delete();

                Session::flash('success', 'Success to delete task list');
                return back();
            } catch (\Throwable $th) {
                Log::debug('Delete Task List error: '.$th);
                Session::flash('error', 'Something went wrong. Please contact system administrator.');
                return back();
            }
        }

        public function paginateTaskList(Request $request) {
            $filter = [
                [ 'master_task_id', $request->id ]
            ];

            if( !empty($request->value) )
                array_push($filter, [$request->key, "LIKE", "%{$request->value}%"]);

            $response = TaskList::where( $filter )
                ->with(['masterTask.workshopBengkel'])
                ->paginate( $request->get( 'size' ) )
                ->toJson();
                
            return view( 'features.bengkel-manager.task-setting.task-list.function.table')
                ->with( 'listdata', json_decode($response, false) );
        }

        public function detailTaskList($id) {
            $response = TaskList::find($id);
            
            return response()->json( $response );
        }
    /* END TASK LIST */
}
