<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CmsUser extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function role() {
        return $this->hasOne('App\Model\Role', 'id', 'role_id');
    }
}
