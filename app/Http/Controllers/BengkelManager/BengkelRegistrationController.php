<?php

namespace App\Http\Controllers\BengkelManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\WorkshopBengkel;
use App\Model\BengkelSetting;
use App\Model\MasterBrand;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Storage;

use Session;

class BengkelRegistrationController extends Controller
{
    public function viewBengkelRegistration() {
        return view( 'features.bengkel-manager.bengkel-registration.main' );
    }

    public function createBengkelRegistration(Request $request) {
        $rollbackDB = false;
        $bengkel = null;

        try {

            $filename = md5(strtotime('now').$request->file('otImage')->getClientOriginalName())
                        . '.'
                        . $request->file('otImage')->getClientOriginalExtension();

            $request->file( 'otImage' )->move(
                public_path('files/workshop-image'),
                $filename
            );

            $bengkel = WorkshopBengkel::create([
                "bengkel_name" => $request->name,
                "bengkel_alamat" => $request->address,
                "bengkel_long" => $request->longitude,
                "bengkel_lat" => $request->latitude,
                "bengkel_tipe" => $request->type,
                "vehicle_type" => $request->get('vehicle-type'),
                "bengkel_status" => 1,
                "created_date" => new \DateTime('now'),
                "oper_task_username" => $request->otUsername,
                "oper_task_password" => $request->otPassword,
                "oper_task_uri" => $request->get('otUri'),
                "workshop_picture" =>  public_path('files/workshop-image' . $filename),
                'pickup_template_id' => $request->otPickupId,
                'delivery_template_id' => $request->otDeliveryId,
            ]);

            $rollbackDB = true;

            BengkelSetting::insert([
                "workshop_bengkel_id" => $bengkel->id,
            ]);

            Session::flash('success', 'Success to create bengkel');
            return back();
        } catch (\Throwable $th) {
            if($rollbackDB) {
                WorkshopBengkel::find($bengkel->id)->delete();
                Log::debug('Create Bengkel Setting error: '.$th);
            } else {
                Log::debug('Create Bengkel Registration error: '.$th);
            }
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function updateBengkelRegistration(Request $request) {
        try {
            $bengkel = WorkshopBengkel::find($request->id);
            $bengkel->bengkel_name = $request->name;
            $bengkel->bengkel_alamat = $request->address;
            $bengkel->bengkel_long = $request->longitude;
            $bengkel->bengkel_lat = $request->latitude;
            $bengkel->bengkel_tipe = $request->type;
            $bengkel->oper_task_username = $request->otUsername;
            $bengkel->pickup_template_id = $request->otPickupId;
            $bengkel->delivery_template_id = $request->otDeliveryId;

            if (isset($request->otPassword)) {
                $bengkel->oper_task_password = $request->otPassword;
            }

            if($request->hasFile('otImage')){
                $filename = md5(strtotime('now').$request->file('otImage')->getClientOriginalName())
                            . '.'
                            . $request->file('otImage')->getClientOriginalExtension();

                $request->file('otImage')
                        ->storeAs(
                            'files/workshop-image',
                            $filename
                );

                $bengkel->workshop_picture = public_path('files/workshop-image' . $filename);
            }

            $bengkel->save();

            Session::flash('success', 'Success to update bengkel');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Update Bengkel Registration error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function updateStatusBengkelRegistration(Request $request) {
        try {
            $bengkel = WorkshopBengkel::find($request->id);
            $bengkel->bengkel_status = !$bengkel->bengkel_status;
            $bengkel->save();

            Session::flash('success', 'Success to update status bengkel');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Update status Bengkel Registration error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function deleteBengkelRegistration(Request $request) {
        try {
            $bengkel = WorkshopBengkel::find($request->id)->delete();

            Session::flash('success', 'Success to delete bengkel');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Delete Bengkel Registration error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function paginateBengkelRegistration(Request $request) {
        $filter = [];

        if( !empty($request->value) )
            array_push($filter, [$request->key, "LIKE", "%{$request->value}%"]);

        $response = WorkshopBengkel::where( $filter )
            ->orderBy('bengkel_name')
            ->paginate( $request->get( 'size' ) )
            ->toJson();

        return view( 'features.bengkel-manager.bengkel-registration.function.table')
            ->with( 'listdata', json_decode($response, false) );
    }

    public function detailBengkelRegistration($id) {
        $response = WorkshopBengkel::find($id);

        return response()->json( $response );
    }

    public function createMasterBrand(Request $request) {
        try {
            MasterBrand::create([
                "brand_name" => $request->name,
                "brand_type" => $request->type,
            ]);

            Session::flash('success', 'Success to create master brand');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Create Master Brand error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }
}
