<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function menus() {
        return $this->belongsToMany('App\MenuMaster', 'role_access', 'role_id', 'menu_id');
    }
}
