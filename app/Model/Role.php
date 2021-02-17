<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function menus() {
        return $this->belongsToMany('App\Model\MenuMaster', 'role_access', 'role_id', 'menu_id');
    }

    public function user() {
        return $this->hasOne('App\Model\CmsUser', 'id', 'role_id');
    }

    public function users() {
        return $this->hasMany('App\Model\CmsUser', 'id', 'role_id');
    }
}
