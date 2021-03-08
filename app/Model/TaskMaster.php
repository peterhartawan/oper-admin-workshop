<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TaskMaster extends Model
{
    public $timestamps = false;

    public function workshopBengkel() {
        return $this->hasOne('App\Model\WorkshopBengkel', 'task_id', 'id');
    }
}
