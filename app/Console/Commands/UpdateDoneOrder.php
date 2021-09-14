<?php

namespace App\Console\Commands;

use App\Model\BookingInfo;
use App\Model\OperOrder;
use App\Services\OperTaskServices;
use App\Services\UtilitiesServices;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateDoneOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'operadmin:update-done-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status order to be done';

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
        /**
         * Get Order With Status Waiting For Driver (Delivery)
         */
        $bookingOrderInfo = DB::select('
            SELECT B.id as order_id, A.oper_task_order_id
            FROM booking_order_info as A
            JOIN oper_orders as B on A.booking_no = B.booking_no
            WHERE B.order_status = ' . OperOrder::GET_DRIVER_AND_SHOW_DRIVER . '
            AND A.order_state = ' . BookingInfo::DELIVERY_STATE_ORDER
        );

        Log::info('UPDATE_DONE_ORDER:BOOKING_ORDER_INFO', [$bookingOrderInfo]);

        /**
         * Get Opertask Token
         */
        $token = new UtilitiesServices();
        $token = $token->getRecentOpertaskToken();

        $service = new OperTaskServices();

        $totalChangedDate = 0;
        foreach ($bookingOrderInfo as $order) {
            /**
             * Web hook
             */
            $response = $service->getOrderByIdOrder(
                $order->oper_task_order_id,
                $token
            );

            /**
             * If the driver is not exist, skip this loop.
             * Or if dispatch time not h-1 from current time
             */

            $dateNow=date_create(date("Y-m-d H:i:s"));
            $dateDispatch=date_create($response->data->dispatch_at);
            $dateDiff=date_diff($dateNow,$dateDispatch);
            if ($response->data->driver === null || $dateDiff->days < 1) {
                continue;
            }

            /**
             * Proceed update status
             */
            $order = OperOrder::where('id', $order->order_id)
                ->get()
                ->first();

            $order->order_status = OperOrder::BOOKING_DONE;
            $order->save();
            $totalChangedDate++;
        }

        Log::info('UPDATE_DONE_ORDER:TOTAL_CHANGED_DATA', [$totalChangedDate]);

        return 0;
    }
}
