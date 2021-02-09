<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Session;

class Authorize
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
            "logout",
            "login",
            "{fallbackPlaceholder}",
        ];

        if( !in_array($request->route()->uri, $exception) ) {
            $authorize = false;
            foreach (Session::get('menus') as $menu) {
                foreach ($menu->children_menus as $subMenu) {
                    if( strpos($subMenu->menu_link, $request->route()->uri) ) 
                        $authorize = true;
                }
            }

            if(!$authorize) {
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
        }

        return $next($request);
    }
}
