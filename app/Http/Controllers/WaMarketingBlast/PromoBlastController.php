<?php

namespace App\Http\Controllers\WaMarketingBlast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\WaPromo;
use App\Model\PromoLog;
use Illuminate\Support\Facades\Log;

use Session;

class PromoBlastController extends Controller
{
    public function viewPromoBlast() {
        return view( 'features.wa-marketing-blast.promo-blast.main' );
    }

    public function createPromoBlast(Request $request) {
        try {
            WaPromo::insert([
                "promo_title" => $request->title,
                "promo_content" => $request->content,
                "promo_image" => 
                    'files/promo-blast/'.$request->file('image')->getClientOriginalName(),
                "created_at" => new \DateTime('now'),
            ]);
    
            $request->file( "image" )->move(
                public_path('files/promo-blast'),
                $request->file( "image" )->getClientOriginalName()
            );
            
            Session::flash('success', 'Success to create promo');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Create Promo Blast error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function updatePromoBlast(Request $request) {
        try {
            if ($request->hasFile('image')) {
                $promo = WaPromo::find($request->id);
                $promo->promo_title = $request->title;
                $promo->promo_content = $request->content;
                $promo->promo_image = 'files/promo-blast/'.$request->file('image')->getClientOriginalName();
                $promo->save();
    
                $request->file( "image" )->move(
                    public_path('files/promo-blast'),
                    $request->file( "image" )->getClientOriginalName()
                );
            } else {
                $promo = WaPromo::find($request->id);
                $promo->promo_title = $request->title;
                $promo->promo_content = $request->content;
                $promo->save();
            }
            
            Session::flash('success', 'Success to update promo');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Update Promo Blast error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function deletePromoBlast(Request $request) {
        try {
            $promo = WaPromo::find($request->id)->delete();

            Session::flash('success', 'Success to delete promo');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Delete Promo Blast error: '.$th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function paginatePromoBlast(Request $request) {
        $filter = [];

        if( !empty($request->value) )
            array_push($filter, [$request->key, "LIKE", "%{$request->value}%"]);

        $response = WaPromo::where( $filter )
            ->withCount('promoLogs as logs')
            ->paginate( $request->get( 'size' ) )
            ->toJson();
            
        return view( 'features.wa-marketing-blast.promo-blast.function.table')
            ->with( 'listdata', json_decode($response, false) );
    }

    public function paginatePromoLog(Request $request) {
        $filter = [];

        if( !empty($request->value) )
            array_push($filter, [$request->key, "LIKE", "%{$request->value}%"]);

        $response = PromoLog::where( $filter )
            ->paginate( $request->get( 'size' ) )
            ->toJson();
            
        return view( 'features.wa-marketing-blast.promo-blast.function.table-logs')
            ->with( 'listdata', json_decode($response, false) );
    }

    public function detailPromoBlast($id) {
        $response = WaPromo::find($id);
        
        return response()->json( $response );
    }
}
