<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MenuMaster extends Model
{
    public function childMenus() {
        return $this->hasMany('App\Model\MenuMaster', 'parent_menu', 'id');
    }
    
    public function childrenMenus() {
        return $this->hasMany('App\Model\MenuMaster', 'parent_menu', 'id')->with('childMenus');
        // MasterMenu::where('parent_menu', null)->with('childrenMenus')->get(); -> recursive array for children
    }
    
    public function roles() {
        return $this->belongsToMany('App\Model\Role', 'role_access', 'menu_id', 'role_id');
    }
}
