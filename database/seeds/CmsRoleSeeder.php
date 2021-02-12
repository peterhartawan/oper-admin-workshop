<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmsRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'role_name' => 'SuperAdmin',
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 2,
                'role_name' => 'Service Advisor',
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 3,
                'role_name' => 'Foreman',
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }
    }
}
