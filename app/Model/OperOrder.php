<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OperOrder extends Model
{
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
