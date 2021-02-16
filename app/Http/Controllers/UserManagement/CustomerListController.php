<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CustomerOper;
use Illuminate\Support\Facades\Log;

use Session;

class CustomerListController extends Controller
{
    public function viewCustomerList() {
        return view( 'features.user-management.customer-list.main' );
    }

    public function createCustomerList(Request $request) {
        try {
            if( CustomerOper::where('customer_email', $request->email)->exists() ) {
                    Session::flash('error', 'Email already exist');
                    return back();
            }

            if( CustomerOper::where('customer_hp', $request->phone)->exists() ) {
                    Session::flash('error', 'Phone already exist');
                    return back();
            }

            CustomerOper::insert([
                "customer_name" => $request->name,
                "customer_email" => $request->email,
                "customer_hp" => $request->phone,
                "joined_date" => new \DateTime('now'),
            ]);
            
            Session::flash('success', 'Success to create customer');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Create Customer List error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function updateCustomerList(Request $request) {
        try {
            $customer = CustomerOper::find($request->id);
            
            if( CustomerOper::where('customer_email', $request->email)->exists() && $request->email !== $customer->customer_email ) {
                    Session::flash('error', 'Email already exist');
                    return back();
            }

            if( CustomerOper::where('customer_hp', $request->phone)->exists() && $request->phone !== $customer->customer_hp ) {
                    Session::flash('error', 'Phone already exist');
                    return back();
            }

            $customer->customer_name = $request->name;
            $customer->customer_email = $request->email;
            $customer->customer_hp = $request->phone;
            $customer->save();
            
            Session::flash('success', 'Success to update customer');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Update Customer List error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function deleteCustomerList(Request $request) {
        try {
            $customer = CustomerOper::find($request->id)->delete();

            Session::flash('success', 'Success to delete customer');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Delete customer error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function paginateCustomerList(Request $request) {
        $filter = [];

        if( !empty($request->value) )
            array_push($filter, [$request->key, "LIKE", "%{$request->value}%"]);

        $response = CustomerOper::where( $filter )
            ->paginate( $request->get( 'size' ) )
            ->toJson();
            
        return view( 'features.user-management.customer-list.function.table')
            ->with( 'listdata', json_decode($response, false) );
    }

    public function detailCustomerList($id) {
        $response = CustomerOper::find($id);
        
        return response()->json( $response );
    }
}
