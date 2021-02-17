<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WaPromo extends Model
{
    public $timestamps = false;

    public function promoLogs() {
        return $this->hasMany('App\Model\PromoLog', 'master_promo_id', 'id');;
    }
}
