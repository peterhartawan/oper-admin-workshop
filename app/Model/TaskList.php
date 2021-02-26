<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    public $timestamps = false;

    public function masterTask() {
        return $this->hasOne('App\Model\TaskMaster', 'id', 'master_task_id');
    }
}
