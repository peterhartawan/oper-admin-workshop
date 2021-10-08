<?php

namespace App\Http\Controllers\ServiceAdvisor;

use App\Helper\MessageHelper;
use App\Http\Controllers\Controller;
use App\Model\CmsUser;
use App\Model\NoSQL\BookingUri;
use Illuminate\Http\Request;
use App\Model\OperOrder;
use Illuminate\Support\Facades\Log;

use Session;

class NewOrderListController extends Controller
{
    public function viewNewOrderList()
    {
        return view('features.service-advisor.new-order-list.main');
    }

    public function updateStatusNewOrderList(Request $request)
    {
        try {
            $order = OperOrder::find($request->id);
            $order->update([
                "order_status" => 2,
                "service_advisor_id" => Session::get("user")->id
            ]);


        } catch (\Throwable $th) {
            Log::debug('Update Status Order error: ' . $th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }

        $bookingUri = BookingUri::where('booking_no', $order->booking_no)->first()->booking_uri;
        $bookingStatusUrl = sprintf("%s/booking-status/status/%s", env("OPERWORKSHOP_FE_URL"), $bookingUri);

        $messanging = new MessageHelper();
        $messanging->sendMessage(
            MessageHelper::WHATSAPP,
            $order->customer_hp,
            (
                "OPER Workshop -\n".
                "Mobil anda sudah sampai ke bengkel dan siap di servis.\n" .
                "Konsultasi dengan service advisor untuk mengetahui kondisi mobil anda.\n\n".
                "Klik link berikut ini untuk melihat proses servis mobil anda:\n\n".
                $bookingStatusUrl
            )
        );

        Session::flash('success', 'Success to update status order');
        return back();
    }

    public function paginateNewOrderList(Request $request)
    {
        $filter = [
            ['order_status', 1]
        ];

        if (!empty($request->value)) {
            array_push($filter, [$request->key, "LIKE", "%{$request->value}%"]);
        }

        $response = OperOrder::where($filter)
            ->where('bengkel_id', Session::get('user')->bengkel_id)
            ->with(['workshopBengkel:id,bengkel_name'])
            ->paginate($request->get('size'))
            ->toJson();

        return view('features.service-advisor.new-order-list.function.table')
            ->with('listdata', json_decode($response, false));
    }

    public function detailNewOrderList($id)
    {
        $response = OperOrder::with([
            'workshopBengkel:id,bengkel_name',
            'vehicleBrand',
            'vehicleType'
        ])
            ->find($id);

        return response()->json($response);
    }
}
