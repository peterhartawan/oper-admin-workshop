<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Services\OperTaskServices;
use App\Services\UtilitiesServices;

use DB;
use App\Model\OperOrder;
use App\Model\BookingInfo;
use Illuminate\Support\Facades\Log;

class SyncDriverStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'opertask:sync-driver-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command to sync and update order\'s status from 0 to 1 or 6 to 7';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info("SYNC_DRIVER:CALLED");
        /**
         * Get Opertask Token
         */

        $token = new UtilitiesServices();
        $token = $token->getRecentOpertaskToken();


        /**
         * Get every single booking info that has oper_orders with status 0, or 6
         */

        $booking_order_info = DB::table('booking_order_info AS A')
            ->leftJoin('oper_orders AS B', 'A.booking_no', '=', 'B.booking_no')
            ->whereIn('B.order_status', [
                OperOrder::WAITING_FOR_DRIVER,
                OperOrder::WAITING_FOR_DRIVER_AFTER_INVOICE
            ])
            ->select('A.oper_task_order_id', 'B.id AS order_id', 'A.order_state')
            ->orderBy('A.id', 'DESC')
            ->get();

        Log::info('SYNC_DRIVER:BOOKING_ORDER_INFO', [$booking_order_info]);

        $service = new OperTaskServices();

        /**
         * Loop through booking_order_info
         */
        $totalChangedData = 0;
        foreach ($booking_order_info as $set) {

            $order = OperOrder
                ::where('id', $set->order_id)
                ->get()
                ->first();

            /**
             * Web hook
             */
            $response = $service->getOrderByIdOrder(
                $set->oper_task_order_id,
                $token
            );
            Log::info('SYNC_DRIVER:GET_ORDER_BY_ID_ORDER', [$booking_order_info]);

            /**
             * If the driver is not exist, skip this loop.
             */

            if ($response->data->driver === null) {
                continue;
            }

            /**
             * Proceed update status
             */
            switch ($set->order_state) {
                case BookingInfo::PICKUP_STATE_ORDER:
                    Log::info('SYNC_DRIVER:PROCEED_UPDATE_STATUS', [BookingInfo::PICKUP_STATE_ORDER]);

                    $order->order_status = 1;
                    $order->save();
                    $totalChangedData++;

                    break;

                case BookingInfo::DELIVERY_STATE_ORDER:
                    Log::info('SYNC_DRIVER:PROCEED_UPDATE_STATUS', [BookingInfo::DELIVERY_STATE_ORDER]);

                    $order->order_status = 7;
                    $order->save();
                    $totalChangedData++;

                    break;

                default:
            }

        }

        Log::info('SYNC_DRIVER:TOTAL_CHANGED_DATA', [$totalChangedData]);
        return $totalChangedData;
    }
}
