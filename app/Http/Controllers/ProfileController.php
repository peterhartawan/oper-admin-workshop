<?php

namespace App\Http\Controllers;

use App\Model\CmsUser;
use Illuminate\Http\Request;

use Session;
use Hash;
use Log;

class ProfileController extends Controller
{
    public function updateProfile(Request $request) {
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
            $user->save();

            if ($user->url_image != null) {
                $array_string = explode("?file=", $user->url_image);
                $user->image = "/".$array_string[1];
            }

            Session::put('user', json_decode($user->toJson(), false));
            
            Session::flash('success', 'Success to update profile');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Update Profile error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }
    
    public function updatePassword(Request $request) {
        try {
            $user = CmsUser::find($request->id);

            if(!Hash::check($request->current, $user->password)){
                Session::flash('error', 'your current password is wrong!');
                return back();
            }
            
            $user->password = Hash::make($request->password);
            $user->save();
            
            Session::flash('success', 'Success to update password');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Update Password error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function updatePicture(Request $request) {
        try {
            $user = CmsUser::with('role:id,role_name')->find($request->id);

            if ($request->hasFile('image')) {
                $user->url_image = 
                    env('APP_URL').'/download?file=files/cms-user/'.$request->file('image')->getClientOriginalName();

                $request->file( "image" )->move(
                    public_path('files/cms-user'),
                    $request->file( "image" )->getClientOriginalName()
                );
            }
            
            $user->save();

            if ($user->url_image != null) {
                $array_string = explode("?file=", $user->url_image);
                $user->image = "/".$array_string[1];
            }

            Session::put('user', json_decode($user->toJson(), false));
            
            Session::flash('success', 'Success to update picture');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Update Picture error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }
}
