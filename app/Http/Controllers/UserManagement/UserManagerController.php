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

            if( CmsUser::where('zoom_key', $request->zoom_key)->exists() ) {
                Session::flash('zoom_key', 'Zoom Key already exist');
                return back();
            }

            if( CmsUser::where('zoom_secret', $request->zoom_secret)->exists() ) {
                Session::flash('zoom_secret', 'Zoom Secret already exist');
                return back();
            }

            $image_name = null;

            if($request->hasFile('image')) {
                /**
                 * Hashing picture name
                 */
                $image_name =
                    md5($request->file('image')->getClientOriginalName().time())
                    .'.'.$request->file('image')->getClientOriginalExtension();

                $request->file( "image" )->move(
                    public_path('files/cms-user'),
                    $image_name
                );
            }

            CmsUser::insert([
                "bengkel_id" => $request->workshop,
                "role_id" => $request->role,
                "bengkel_id" => $request->get('workshop'),
                "username" => $request->username,
                "password" => Hash::make('admin12345'),
                "email" => $request->email,
                "phone" => $request->phone,
                "status" => 1,
                "is_bengkel_staff" => 1,
                "url_image" =>
                    $image_name != null ?
                    env('APP_URL').'/download?file=files/cms-user/'.$image_name
                    : null,
                "zoom_key" => $request->zoom_key,
                "zoom_secret" => $request->zoom_secret,
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

            if( !is_null($request->zoom_key) && CmsUser::where('zoom_key', $request->zoom_key)->exists() && $request->zoom_key !== $user->zoom_key ) {
                Session::flash('zoom_key', 'Zoom Key already exist');
                return back();
            }

            if( !is_null($request->zoom_secret) && CmsUser::where('zoom_secret', $request->zoom_secret)->exists() && $request->zoom_secret !== $user->zoom_secret ) {
                Session::flash('zoom_secret', 'Zoom Secret already exist');
                return back();
            }

            if($request->hasFile('image')) {

                /**
                 * Hashing picture name
                 */
                $image_name =
                    md5($request->file('image')->getClientOriginalName().time())
                    .'.'.$request->file('image')->getClientOriginalExtension();

                $request->file( "image" )->move(
                    public_path('files/cms-user'),
                    $image_name
                );

                $user->url_image =
                    env('APP_URL').'/download?file=files/cms-user/'.$image_name;
            }

            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role_id = $request->role;
            if(!is_null($request->zoom_key)) {
                $user->zoom_key = $request->zoom_key;
            }
            if(!is_null($request->zoom_secret)) {
                $user->zoom_secret = $request->zoom_secret;
            }
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

        if (!is_null($response->zoom_key)) {
            $response->zoom_key = "***".substr($response->zoom_key, -3);
        }

        if (!is_null($response->zoom_secret)) {
            $response->zoom_secret = "***".substr($response->zoom_secret, -3);
        }

        return response()->json( $response );
    }
}
