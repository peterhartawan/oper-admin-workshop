<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ForemanTaskProgress extends Model
{
    protected $table = "task_progress";

    public function operOrder(){
        return $this->belongsTo('App\Model\OperOrder', 'id', 'order_id');
    }

    public function task(){
        return $this->hasOne('App\Model\TaskList', 'id', 'task_id');
    }
}
