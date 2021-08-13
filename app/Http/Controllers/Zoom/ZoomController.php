<?php

namespace App\Http\Controllers\Zoom;

use App\Model\NoSQL\BookingUri;
use App\Model\NoSQL\ZoomRoom;
use App\Model\OperOrder;
use App\Services\ZoomApiServices;
use Illuminate\Http\Request;

class ZoomController
{
    public function zoomMeeting($booking_no, Request $request)
    {
        // Get Booking Uri
        $bookingUri = BookingUri::where('booking_no', $booking_no)->first();

        if (is_null($bookingUri)) {
            return redirect()->back()->with(['message' => 'Order Booking Not Found']);
        }

        // Get current order's super advisor
        $order = OperOrder::where('booking_no', $booking_no)->first();
        $orderServiceAdvisor = $order->service_advisor()->first();

        // Get zoom key secret
        $key = $orderServiceAdvisor->zoom_key;
        $secret = $orderServiceAdvisor->zoom_secret;
        $zoomService = new ZoomApiServices($key, $secret);

        // Get order's zoom meeting
        $zoomRoom = ZoomRoom::where('booking_no', $booking_no)->orderBy('created_at', 'desc')->first();

        // Check is zoom room still exists
        $zoomExist = false;
        if (!is_null($zoomRoom)) {
            $zoomMeet = $zoomService->checkMeeting($zoomRoom['meeting_number']);

            if ($zoomMeet['code'] != ZoomApiServices::ERR_MEET_NOT_EXIST) {
                $zoomExist = true;
            }
        }

        // Check need to end other meeting
        $needToEndOtherMeeting = false;
        if ($request->has('end_other_meeting')) {
            $needToEndOtherMeeting = $request->get('end_other_meeting') == 1;
        }

        // Check is zoom meeting room exists
        if ($zoomExist && !$needToEndOtherMeeting) {
            $zoomMeetingNumber = $zoomRoom->meeting_number;
            $zoomMeetingPassword = $zoomRoom->meeting_password;
        } else {
            // Create new zoom meeting room

            // Get zoom's user
            $zoomUser = $zoomService->getUser($orderServiceAdvisor->email);
            if ($zoomUser['code'] == ZoomApiServices::ERR_USER_NOT_FOUND) {
                return redirect()->back()
                    ->with(['message' => 'Maaf, terdapat kesalahan dalam pembuatan zoom meeting pada akun Anda. Mohon hubungi administrator untuk info lebih lanjut.']);
            }

            // End all not used meeting
            if ($needToEndOtherMeeting) {
                while (true) {
                    $zoomListMeeting = $zoomService->listMeeting($zoomUser['id']);

                    if ($zoomListMeeting['total_records'] == 0) {
                        break;
                    }

                    foreach ($zoomListMeeting['meetings'] as $k => $v) {
                        $res1 = $zoomService->forceEndMeeting($v['id']);
                        $res2 = $zoomService->deleteMeeting($v['id']);
                    }
                }
            }

            // Create zoom meeting
            $zoomMeet = $zoomService->createMeeting($zoomUser['id']);

            $zoomMeetingNumber = $zoomMeet['id'];
            $zoomMeetingPassword =$zoomMeet['encrypted_password'];

            $zoomRoom = new ZoomRoom();
            $zoomRoom->booking_uri = $bookingUri->booking_uri;
            $zoomRoom->booking_no = $booking_no;
            $zoomRoom->meeting_number = $zoomMeetingNumber;
            $zoomRoom->meeting_password = $zoomMeetingPassword;
            $zoomRoom->created_at = new \DateTime('now');
            $zoomRoom->save();
        }

        return view('features.service-advisor.zoom.meeting')
            ->with([
                'mn' => $zoomMeetingNumber,
                'pwd' => $zoomMeetingPassword,
                'name' => $orderServiceAdvisor->username,
                'email' => $orderServiceAdvisor->email,
                'bookingNo' => $booking_no,
                'zoomKey' => base64_encode($key),
                'zoomSecret' => base64_encode($secret)
            ]);
    }
}
