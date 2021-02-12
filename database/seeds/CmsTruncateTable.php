<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmsTruncateTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // For Table role_access
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('role_access')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // For Table menu_masters
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('menu_masters')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // For Table cms_users
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // For Table roles
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('cms_users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
