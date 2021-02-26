<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TaskMaster extends Model
{
    public $timestamps = false;

    public function workshopBengkels() {
        return $this->belongsToMany('App\Model\WorkshopBengkel', 'workshop_task', 'master_task_id', 'bengkel_id');
    }
}
