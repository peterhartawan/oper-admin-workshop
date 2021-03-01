<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WorkshopBengkel extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function masterTasks() {
        return $this->belongsToMany('App\Model\TaskMaster', 'workshop_task', 'bengkel_id', 'master_task_id');
    }
}
