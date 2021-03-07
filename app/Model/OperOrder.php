<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OperOrder extends Model
{
    /**
     * @var integer
     * '
     * Reference to `order_status`
     * 
     * Flow: 0 - 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8
     * Out of flow: -1
     */
    const WAITING_FOR_DRIVER = 0;
    const GET_DRIVER = 1;
    const SERVICE_ADVISOR_OPEN_ORDER = 2;
    const SERVICE_ADVISOR_SUBMIT_PKB = 3;
    const FOREMAN_TASK = 4;
    const SERVICE_ADVISOR_UPLOAD_INVOICE = 5;
    const WAITING_FOR_DRIVER_AFTER_INVOICE = 6;
    const GET_DRIVER_AND_SHOW_DRIVER = 7;
    const BOOKING_DONE = 8;
    const BOOKING_CANCELED = -1;

    public $timestamps = false;
    protected $guarded = [];

    public function workshopBengkel() {
        return $this->hasOne("App\Model\WorkshopBengkel", "id", "bengkel_id");
    }

    public function vehicleBrand() {
        return $this->hasOne("App\Model\MasterBrand", "id", "vehicle_brand");
    }

    public function vehicleType() {
        return $this->hasOne("App\Model\VehicleName", "id", "vehicle_type");
    }
}
