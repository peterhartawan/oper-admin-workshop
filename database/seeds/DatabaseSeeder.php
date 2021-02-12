<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CmsTruncateTable::class);
        $this->call(CmsRoleSeeder::class);
        $this->call(CmsMenuSeeder::class);
        $this->call(CmsRoleAccessSeeder::class);
        $this->call(CmsUserSeeder::class);
    }
}
