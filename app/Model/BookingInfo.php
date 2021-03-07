<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BookingInfo extends Model
{
    /**
     * @static
     * @var integer
     * 
     * Reference to `order_state` 
     * 1 for order status 0
     * 2 for order status 6
     */
    const PICKUP_STATE_ORDER = 1;
    const DELIVERY_STATE_ORDER = 2;

    protected $table = "booking_order_info";

    public $timestamps = false;

    public function oper_order(){
        return $this->belongsTo('App\Model\OperOrder', 'booking_no', 'booking_no');
    }
}
