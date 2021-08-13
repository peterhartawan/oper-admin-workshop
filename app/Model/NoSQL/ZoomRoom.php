<?php

namespace App\Model\NoSQL;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ZoomRoom extends Eloquent{
    protected $connection = 'mongodb';
    protected $collection = 'zoom_room';

    protected $fillable = [
        /**
         * @var BookingUri::booking_no booking_no
         * booking_uri contains hashed uri that later will be used to
         * get resources from this
         */
        'booking_uri',

        /**
         * @var \App\Model\OperOrder::booking_no booking_no
         * @see \App\Controllers\Api\BookingController :138 for more information
         */
        'booking_no',

        /**
         * @var string
         * Zoom Room meeting number
         */
        'meeting_number',

        /**
         * @var string
         * Zoom Room meeting password
         */
        'meeting_password',

        /**
         * @var \DateTime::class created_at
         * Reference to created data's time.
         */
        'created_at'
    ];
}
