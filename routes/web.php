<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix( 'login' )->group(function() {
    Route::get ( '', 'AuthController@loginPage' );
    Route::post( '', 'AuthController@login' );
});

Route::prefix( 'logout' )->group(function() {
    Route::get ( '', 'AuthController@logout' );
});

/* 
|--------------------------------------------------------------------------
| User Management Routes
|--------------------------------------------------------------------------
*/

    Route::prefix( 'user-management' )->group(function() {

        Route::prefix( 'user-manager' )->group(function() {
            Route::get   ( '', 'UserManagement\UserManagerController@userManagerPage' );
            // Route::put   ( '', '' );
            // Route::post  ( '', '' );
            // Route::delete( '', '' );
        });
    
        Route::prefix( 'customer-list' )->group(function() {
            Route::get   ( '', 'UserManagement\CustomerListController@customerListPage' );
            // Route::put   ( '', '' );
            // Route::post  ( '', '' );
            // Route::delete( '', '' );
        });

        Route::fallback(function() {
            return redirect( "/user-management/user-manager" );
        });

    });
    
/* 
|--------------------------------------------------------------------------
| End of User Management Routes
|--------------------------------------------------------------------------
*/

/* 
|--------------------------------------------------------------------------
| Bengkel Manager Routes
|--------------------------------------------------------------------------
*/

    Route::prefix( 'bengkel-manager' )->group(function() {

        Route::prefix( 'bengkel-registration' )->group(function() {
            Route::get   ( '', 'BengkelManager\BengkelRegistrationController@bengkelRegistrationPage' );
            // Route::put   ( '', '' );
            // Route::post  ( '', '' );
            // Route::delete( '', '' );
        });
    
        Route::prefix( 'bengkel-setting' )->group(function() {
            Route::get   ( '', 'BengkelManager\BengkelSettingController@bengkelSettingPage' );
            // Route::put   ( '', '' );
            // Route::post  ( '', '' );
            // Route::delete( '', '' );
        });
    
        Route::prefix( 'task-setting' )->group(function() {
            Route::get   ( '', 'BengkelManager\TaskSettingController@taskSettingPage' );
            // Route::put   ( '', '' );
            // Route::post  ( '', '' );
            // Route::delete( '', '' );
        });

        Route::fallback(function() {
            return redirect( "/bengkel-manager/bengkel-registration" );
        });

    });

/* 
|--------------------------------------------------------------------------
| End of Bengkel Manager Routes
|--------------------------------------------------------------------------
*/

/* 
|--------------------------------------------------------------------------
| Wa Marketing Blast Routes
|--------------------------------------------------------------------------
*/

    Route::prefix( 'wa-marketing-blast' )->group(function() {

        Route::prefix( 'dashboard-wa' )->group(function() {
            Route::get   ( '', 'WaMarketingBlast\DashboardWaController@dashboardWaPage' );
            // Route::put   ( '', '' );
            // Route::post  ( '', '' );
            // Route::delete( '', '' );
        });
    
        Route::prefix( 'promo-blast' )->group(function() {
            Route::get   ( '', 'WaMarketingBlast\PromoBlastController@promoBlastPage' );
            // Route::put   ( '', '' );
            // Route::post  ( '', '' );
            // Route::delete( '', '' );
        });

        Route::fallback(function() {
            return redirect( "/wa-marketing-blast/dashboard-wa" );
        });

    });

/* 
|--------------------------------------------------------------------------
| End of Wa Marketing Blast Routes
|--------------------------------------------------------------------------
*/

/* 
|--------------------------------------------------------------------------
| Service Advisor Routes
|--------------------------------------------------------------------------
*/

    Route::prefix( 'service-advisor' )->group(function() {

        Route::prefix( 'new-order-list' )->group(function() {
            Route::get   ( '', 'ServiceAdvisor\NewOrderListController@newOrderListPage' );
            // Route::put   ( '', '' );
            // Route::post  ( '', '' );
            // Route::delete( '', '' );
        });
    
        Route::prefix( 'order-inprogress' )->group(function() {
            Route::get   ( '', 'ServiceAdvisor\OrderInProgressController@orderInProgressPage' );
            // Route::put   ( '', '' );
            // Route::post  ( '', '' );
            // Route::delete( '', '' );
        });

        Route::fallback(function() {
            return redirect( "/service-advisor/new-order-list" );
        });

    });

/* 
|--------------------------------------------------------------------------
| End of Service Advisor Routes
|--------------------------------------------------------------------------
*/

/* 
|--------------------------------------------------------------------------
| Foreman Routes
|--------------------------------------------------------------------------
*/

    Route::prefix( 'foreman' )->group(function() {

        Route::prefix( 'dashboard' )->group(function() {
            Route::get   ( '', 'Foreman\dashboardController@DashboardPage' );
            // Route::put   ( '', '' );
            // Route::post  ( '', '' );
            // Route::delete( '', '' );
        });
    
        Route::prefix( 'order-list' )->group(function() {
            Route::get   ( '', 'Foreman\orderListController@OrderListPage' );
            // Route::put   ( '', '' );
            // Route::post  ( '', '' );
            // Route::delete( '', '' );
        });

        Route::fallback(function() {
            return redirect( "/foreman/dashboard" );
        });
        
    });

/* 
|--------------------------------------------------------------------------
| End of Foreman Routes
|--------------------------------------------------------------------------
*/

Route::fallback(function($url) {
    switch ($url) {
        case 'user-management':
            return redirect( "/user-management/user-manager" );
            break;

        case 'bengkel-manager':
            return redirect( "/bengkel-manager/bengkel-registration" );
            break;
        
        case 'wa-marketing-blast':
            return redirect( "/wa-marketing-blast/dashboard-wa" );
            break;

        case 'service-advisor':
            return redirect( "/service-advisor/new-order-list" );
            break;

        case 'foreman':
            return redirect( "/foreman/dashboard" );
            break;

        default:
            return redirect( "/" );
            break;
    }
});