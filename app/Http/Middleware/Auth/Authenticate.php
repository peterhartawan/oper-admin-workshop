<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Session;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $exception = [
            "/",
            "login",
            "logs",
            "command"
        ];

        if ( !in_array($request->route()->uri, $exception) && empty(Session::get('user'))) {
            return redirect('/');
        }else if ( !empty(Session::get('user')) && in_array($request->route()->uri,$exception) ){
            switch ( Session::get('role') ) {
                case 'superadmin':
                    return redirect('/user-management/user-manager');
                    break;

                case 'serviceadvisor':
                    return redirect( "/service-advisor/new-order-list" );
                    break;

                case 'foreman':
                    return redirect( "/foreman/dashboard" );
                    break;
            }
        }

        return $next($request);
    }
}
