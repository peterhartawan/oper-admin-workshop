<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmsRoleAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_accesses = [
            [
                'id' => 1,
                'menu_id' => 1,
                'role_id' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 2,
                'menu_id' => 6,
                'role_id' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 3,
                'menu_id' => 7,
                'role_id' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 4,
                'menu_id' => 2,
                'role_id' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 5,
                'menu_id' => 8,
                'role_id' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 6,
                'menu_id' => 9,
                'role_id' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 7,
                'menu_id' => 10,
                'role_id' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 8,
                'menu_id' => 3,
                'role_id' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 9,
                'menu_id' => 11,
                'role_id' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 10,
                'menu_id' => 12,
                'role_id' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 11,
                'menu_id' => 4,
                'role_id' => 2,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 12,
                'menu_id' => 13,
                'role_id' => 2,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 13,
                'menu_id' => 14,
                'role_id' => 2,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 14,
                'menu_id' => 5,
                'role_id' => 3,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 15,
                'menu_id' => 15,
                'role_id' => 3,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 16,
                'menu_id' => 16,
                'role_id' => 3,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
        ];

        foreach ($role_accesses as $role_access) {
            DB::table('role_access')->insert($role_access);
        }
    }
}
