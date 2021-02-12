<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CmsUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Users = [
            [
                'id' => 1,
                'role_id' => 1,
                'bengkel_id' => null,
                'username' => 'superadmin',
                'password' => Hash::make('admin12345'),
                'email' => 'superadmin@gmail.com',
                'phone' => '081313131313',
                'status' => 1,
                'is_bengkel_staff' => 0,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'role_id' => 2,
                'bengkel_id' => null,
                'username' => 'serviceadvisor',
                'password' => Hash::make('admin12345'),
                'email' => 'serviceadvisor@gmail.com',
                'phone' => '081313131314',
                'status' => 1,
                'is_bengkel_staff' => 0,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => 3,
                'role_id' => 1,
                'bengkel_id' => null,
                'username' => 'foreman',
                'password' => Hash::make('admin12345'),
                'email' => 'foreman@gmail.com',
                'phone' => '081313131315',
                'status' => 1,
                'is_bengkel_staff' => 0,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
                'deleted_at' => null,
            ],
        ];

        foreach ($Users as $user) {
            DB::table('cms_users')->insert($user);
        }
    }
}
