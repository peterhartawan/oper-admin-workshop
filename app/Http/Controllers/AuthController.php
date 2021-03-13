<?php

namespace App\Http\Controllers;

use App\Model\CmsUser;
use App\Model\MenuMaster;
use Illuminate\Http\Request;

use Validator;
use Session;
use Hash;

class AuthController extends Controller
{
    /**
     * Display login page
     * 
     * @return page login
     */
    public function loginPage() {
        return view('auth.login');
    }

    /**
     * Login with credential
     * 
     * @param Illuminate\Http\Request $request
     * @return page login or dashboard
     */
    public function login(Request $request) {
        $validate = Validator::make($request->all(), [
            "username" => 'required',
            "password" => "required"
        ]);

        if ($validate->fails()) {
            $error = $validate->errors()->first();

            Session::flash('error', $error);
            return redirect('/login');
        }

        $user = CmsUser::with('role:id,role_name')
                    ->firstWhere('username', '=', $request->username);

        if(!isset($user)){
            Session::flash('error', 'Username cannot found!');
            return redirect('/login');
        }

        if(!Hash::check($request->password, $user->password)){
            Session::flash('error', 'Password wrong!');
            return redirect('/login');
        }
        
        if ($user->url_image != null) {
            $array_string = explode("?file=", $user->url_image);
            $user->image = "/".$array_string[1];
        }

        $menus = MenuMaster::with([
                        'childrenMenus' => function($query) use ($user) {
                            $query->whereHas('roles', function($query) use ($user) {
                                $query->where('role_id', $user->role->id);
                            });
                        }
                    ])->where('parent_menu', null)
                    ->whereHas('roles', function($query) use ($user) {
                        $query->where('role_id', $user->role->id);
                    })->get();

        Session::put('user', json_decode($user->toJson(), false));
        Session::put('menus', json_decode($menus->toJson(), false));
        switch ( strtolower(Session::get('user')->role->role_name) ) {
            case 'superadmin':
                Session::put('role', 'superadmin');
                return redirect('/user-management/user-manager');
                break;

            case 'service advisor':
                Session::put('role', 'serviceadvisor');
                return redirect( "/service-advisor/new-order-list" );
                break;
                
            case 'foreman':
                Session::put('role', 'foreman');
                return redirect( "/foreman/dashboard" );
                break;

            default:
                $this->logout();
                Session::flash('error', 'Role undefined!');
                return redirect('/login');
                break;
        }
    }

    public function logout() {
        Session::flush();
        Session::save();
        Session::regenerate(true);
        return redirect('/');
    }
}
