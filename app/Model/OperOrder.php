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
     * Flow: 0 - 1 - 2 - 3 - 9 - 4 - 10 - 5 - 6 - 7 - 8
     * Out of flow: -1
     */
    const WAITING_FOR_DRIVER = 0;
    const GET_DRIVER = 1;
    const SERVICE_ADVISOR_OPEN_ORDER = 2;
    const SERVICE_ADVISOR_SUBMIT_PKB = 3;
    const PKB_CONFIRMED = 9;
    const FOREMAN_TASK = 4;
    const FOREMAN_TASK_DONE = 10;
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

    public function tasks() {
        return $this->hasMany('App\Model\ForemanTaskProgress', 'order_id', 'id');
    }

    public function taskMaster(){
        return $this->hasOne('App\Model\TaskMaster', 'id', 'master_task');
    }

    public function service_advisor(){
        return $this->hasOne('App\Model\CmsUser', 'id', 'service_advisor_id');
    }
}
