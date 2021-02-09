<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsUser extends Model
{
    public function role() {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }
}
