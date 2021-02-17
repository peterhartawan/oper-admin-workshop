<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BengkelSetting extends Model
{
    public $timestamps = false;

    public function workshopBengkel() {
        return $this->hasOne('App\Model\WorkshopBengkel', 'id', 'workshop_bengkel_id');
    }
}
