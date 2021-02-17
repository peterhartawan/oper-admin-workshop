<?php

namespace App\Http\Controllers\BengkelManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CmsUser;
use App\Model\Role;
use Illuminate\Support\Facades\Log;

use Session;

class BengkelSettingController extends Controller
{
    public function viewBengkelSetting() {
        $roles = Role::where( "role_name", "NOT LIKE", "%superadmin%" )
                        ->get()
                        ->toJson();
        return view( 'features.bengkel-manager.bengkel-setting.main' )
            ->with( 'roles', json_decode($roles, false) );
    }

    public function createBengkelSetting(Request $request) {
        try {
            if( CmsUser::where('username', $request->username)->exists() ) {
                    Session::flash('error', 'Username already exist');
                    return back();
            }

            if( CmsUser::where('email', $request->email)->exists() ) {
                    Session::flash('error', 'Email already exist');
                    return back();
            }

            if( CmsUser::where('phone', $request->phone)->exists() ) {
                    Session::flash('error', 'Phone already exist');
                    return back();
            }

            CmsUser::insert([
                "role_id" => $request->role,
                "bengkel_id" => null,
                "username" => $request->username,
                "password" => Hash::make('admin12345'),
                "email" => $request->email,
                "phone" => $request->phone,
                "status" => 1,
                "is_bengkel_staff" => 0,
                "created_at" => new \DateTime('now'),
                "updated_at" => null,
                "deleted_at" => null,
            ]);
            
            Session::flash('success', 'Success to create user');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Create User Manager error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function updateBengkelSetting(Request $request) {
        try {
            $user = CmsUser::find($request->id);

            if( CmsUser::where('username', $request->username)->exists() && $request->username !== $user->username ) {
                    Session::flash('error', 'Username already exist');
                    return back();
            }

            if( CmsUser::where('email', $request->email)->exists() && $request->email !== $user->email ) {
                    Session::flash('error', 'Email already exist');
                    return back();
            }

            if( CmsUser::where('phone', $request->phone)->exists() && $request->phone !== $user->phone ) {
                    Session::flash('error', 'Phone already exist');
                    return back();
            }

            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role_id = $request->role;
            $user->save();
            
            Session::flash('success', 'Success to update user');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Update User Manager error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function updateStatusBengkelSetting(Request $request) {
        try {
            $user = CmsUser::find($request->id);
            $user->status = !$user->status;
            $user->save();

            Session::flash('success', 'Success to update status user');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Update status User Manager error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function deleteBengkelSetting(Request $request) {
        try {
            $user = CmsUser::find($request->id)->delete();

            Session::flash('success', 'Success to delete user');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Delete User Manager error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function paginateBengkelSetting(Request $request) {
        $filter = [];

        if( !empty($request->value) )
            array_push($filter, [$request->key, "LIKE", "%{$request->value}%"]);

        $response = CmsUser::where( $filter )
            ->whereNotIn( "id", [Session::get('user')->id] )
            ->whereDoesntHave( "role", function($query) {
                $query->where( "role_name", "LIKE", "%superadmin%" );
            })
            ->with(['role:id,role_name'])
            ->paginate( $request->get( 'size' ) )
            ->toJson();
            
        return view( 'features.bengkel-manager.bengkel-setting.function.table')
            ->with( 'listdata', json_decode($response, false) );
    }

    public function detailBengkelSetting($id) {
        $response = CmsUser::find($id);
        
        return response()->json( $response );
    }
}
