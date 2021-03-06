<?php

namespace App\Http\Controllers\ServiceAdvisor;

use App\Helper\MessageHelper;
use App\Http\Controllers\Controller;
use App\Model\NoSQL\BookingUri;
use App\Model\WorkshopBengkel;
use Illuminate\Http\Request;
use App\Model\OperOrder;
use Illuminate\Support\Facades\Log;

use Session;

use App\Services\OperTaskServices;
use App\Services\UtilitiesServices;

use App\Model\BookingInfo;

use Illuminate\Support\Facades\Storage;

class OrderInProgressController extends Controller
{
    public function viewOrderInProgress()
    {
        return view('features.service-advisor.order-inprogress.main');
    }

    public function updateOrderInProgress(Request $request)
    {
        try {
            $order = OperOrder
                ::with([
                    'vehicleBrand',
                    'workshopBengkel'
                ])
                ->where('id', $request->id)
                ->get()
                ->first();

            if ($order->order_status == OperOrder::SERVICE_ADVISOR_OPEN_ORDER) {
                $order->update([
                    "pkb_file" =>
                        env('APP_URL') . '/download?file=files/pkb/' . $request->file('file')->getClientOriginalName(),
                    "order_status" => 3
                ]);

                $request->file("file")->move(
                    public_path('files/pkb'),
                    $request->file("file")->getClientOriginalName()
                );
            } else if ($order->order_status == OperOrder::SERVICE_ADVISOR_SUBMIT_PKB) {
                $order->update([
                    "order_status" => 9
                ]);

                $bookingUri = BookingUri::where('booking_no', $order->booking_no)->first()->booking_uri;
                $bookingStatusUrl = sprintf("%s/booking-status/status/%s", env("OPERWORKSHOP_FE_URL"), $bookingUri);

                $messanging = new MessageHelper();
                $messanging->sendMessage(
                    MessageHelper::WHATSAPP,
                    $order->customer_hp,
                    (
                        "OPER Workshop -\n".
                        "Anda sudah berkonsultasi dengan service advisor.\n" .
                        "Kini mobil anda sedang memasuki proses servis sesuai dengan hasil diskusi dengan service advisor.\n\n".
                        "Pantau proses servis kendaraan anda melalui link berikut ini:\n\n".
                        $bookingStatusUrl
                    )
                );
            } else if ($order->order_status == OperOrder::FOREMAN_TASK_DONE) {

                $filename = md5(strtotime('now') . $request->file('file')->getClientOriginalName())
                    . '.'
                    . $request->file('file')->getClientOriginalExtension();

                $request->file( 'file' )->move(
                    public_path('files/invoice'),
                    $filename
                );

                $order->update([
                    "order_status" => OperOrder::SERVICE_ADVISOR_UPLOAD_INVOICE,
                    "invoice_file" => $filename
                ]);

            } else if ($order->order_status == OperOrder::SERVICE_ADVISOR_UPLOAD_INVOICE) {

                /**
                 * Insert image
                 */


                /**
                 * Begin hit to opertask
                 */

                $service = new OperTaskServices();

                $message =
                    "Kode Booking : {$order->booking_code} \n\n"
                    . "Nama Konsumen : {$order->customer_name}\n\n"
                    . "Telfon Konsumen : {$order->customer_hp}\n\n"
                    . "Tipe Kendaraan : {$order->vehicleBrand->brand_name} {$order->vehicle_name}\n\n"
                    . "Waktu Booking : {$order->booking_time}\n\n"
                    . "Harap sebutkan kode booking ketika hendak menghubungi konsumen melalui Whatsapp.";


                $workshopBengkel = WorkshopBengkel::find($order->bengkel_id);

                $token = new UtilitiesServices();
                $token = $token->getRecentOpertaskToken();

                $response = $service->sendOrder(
                    [
                        "task_template_id" => $workshopBengkel->delivery_template_id,
                        "booking_time" => date('Y-m-d H:i:s', strtotime('now')),
                        "origin_latitude" => $order->customer_lat,
                        "origin_longitude" => $order->customer_long,
                        "destination_latitude" => $order->workshopBengkel->bengkel_lat,
                        "destination_longitude" => $order->workshopBengkel->bengkel_long,
                        "user_fullname" => $order->customer_name,
                        "user_phonenumber" => $order->customer_hp,
                        "vehicle_owner" => $order->customer_name,
                        "vehicle_brand_id" => strval($order->vehicle_brand),
                        "vehicle_type" => $order->vehicle_name,
                        "vehicle_transmission" => "CVT",
                        "client_vehicle_license" => $order->vehicle_plat,
                        "message" => $message
                    ],
                    $token
                );


                /**
                 * Insert booking info
                 */
                $info = new BookingInfo();
                $info->booking_no = $order->booking_no;
                $info->oper_task_order_id = $response->data->idorder;
                $info->oper_task_trx_id = $response->data->trx_id;
                $info->order_state = BookingInfo::DELIVERY_STATE_ORDER;
                $info->save();

                /**
                 * Update state
                 */
                $order->update([
                    "order_status" => OperOrder::WAITING_FOR_DRIVER_AFTER_INVOICE
                ]);

                $bookingUri = BookingUri::where('booking_no', $order->booking_no)->first()->booking_uri;
                $bookingStatusUrl = sprintf("%s/booking-status/status/%s", env("OPERWORKSHOP_FE_URL"), $bookingUri);

                $messanging = new MessageHelper();
                $messanging->sendMessage(
                    MessageHelper::WHATSAPP,
                    $order->customer_hp,
                    (
                        "OPER Workshop -\n".
                        "Pembayaran anda sudah diterima.\n" .
                        "Kini mobil anda siap diantar kembali.Terima kasih sudah menggunakan OPER Workshop.\n\n".
                        "Klik link untuk melakukan tracking kendaraan anda:\n\n".
                        $bookingStatusUrl
                    )
                );
            }

            Session::flash('success', 'Success to update status order');
            return back();
        } catch (\Throwable $th) {
            Log::debug('Update Status Order error: ' . $th);
            Session::flash('error', 'Something went wrong. Please contact system administrator.');
            return back();
        }
    }

    public function paginateOrderInProgress(Request $request)
    {
        $filter = [
            ["service_advisor_id", Session::get("user")->id]
        ];

        if (!empty($request->value))
            array_push($filter, [$request->key, "LIKE", "%{$request->value}%"]);

        $response = OperOrder::where($filter)
            ->whereIn("order_status", [2, 3, 10, 5])
            ->with(['workshopBengkel:id,bengkel_name'])
            ->paginate($request->get('size'))
            ->toJson();

        return view('features.service-advisor.order-inprogress.function.table')
            ->with('listdata', json_decode($response, false));
    }

    public function detailOrderInProgress($id)
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
