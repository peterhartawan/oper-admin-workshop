<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CmsUser;
use App\Model\Role;
use App\Model\WorkshopBengkel;
use Illuminate\Support\Facades\Log;

use Session;
use Hash;

class UserManagerController extends Controller
{
    public function viewUserManager() {
        $roles = Role::where( "role_name", "NOT LIKE", "%superadmin%" )
                        ->get()
                        ->toJson();
        $bengkels = WorkshopBengkel::get()->toJson();
        
        return view( 'features.user-management.user-manager.main' )
            ->with( 'roles', json_decode($roles, false) )
            ->with( 'bengkels', json_decode($bengkels, false) );
    }

    public function createUserManager(Request $request) {
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
                "bengkel_id" => $request->workshop,
                "role_id" => $request->role,
                "bengkel_id" => null,
                "username" => $request->username,
                "password" => Hash::make('admin12345'),
                "email" => $request->email,
                "phone" => $request->phone,
                "status" => 1,
                "is_bengkel_staff" => 1,
                "url_image" => 
                    env('APP_URL').'/download?file=files/cms-user/'.$request->file('image')->getClientOriginalName(),
                "created_at" => new \DateTime('now'),
                "updated_at" => null,
                "deleted_at" => null,
            ]);

            $request->file( "image" )->move(
                public_path('files/cms-user'),
                $request->file( "image" )->getClientOriginalName()
            );
            
            Session::flash('success', 'Success to create user');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Create User Manager error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function updateUserManager(Request $request) {
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

            if ($request->hasFile('image')) {
                $user->url_image = 
                    env('APP_URL').'/download?file=files/cms-user/'.$request->file('image')->getClientOriginalName();

                $request->file( "image" )->move(
                    public_path('files/cms-user'),
                    $request->file( "image" )->getClientOriginalName()
                );
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

    public function updateStatusUserManager(Request $request) {
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

    public function deleteUserManager(Request $request) {
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

    public function paginateUserManager(Request $request) {
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
            
        return view( 'features.user-management.user-manager.function.table')
            ->with( 'listdata', json_decode($response, false) );
    }

    public function detailUserManager($id) {
        $response = CmsUser::find($id);
        if ($response->url_image != null) {
            $array_string = explode("?file=", $response->url_image);
            $response->image = "/".$array_string[1];
        }
        
        return response()->json( $response );
    }
}
