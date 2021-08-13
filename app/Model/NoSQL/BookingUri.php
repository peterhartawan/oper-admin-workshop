<?php

namespace App\Model\NoSQL;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class BookingUri extends Eloquent{
    protected $connection = 'mongodb';
    protected $collection = 'opertask_booking_url';

    protected $fillable = [

        /**
         * @var string booking_uri
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
         * @var \App\Model\OperOrder::booking_time booking_time
         */
        'booking_time',
        
        /**
         * @var string vehicle_type_and_brand
         * Concatination of Vehicle Brand and Name
         */
        'vehicle_type_and_brand',

        /**
         * @var \App\Model\OperOrder::vehicle_plat vehicle_license_plat
         */
        'vehicle_license_plat',

        /**
         * @var integer visit_counter
         * An integer that determines how much time this link was clicked.
         */
        'visit_counter',

        /**
         * @var \DateTime::class created_at
         * Reference to created data's time.
         */
        'created_at'
    ];
}