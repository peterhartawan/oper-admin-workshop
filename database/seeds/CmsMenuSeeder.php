<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmsMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'id' => 1,
                'menu_name' => 'User Management',
                'menu_link' => '/user-management',
                'menu_icon' => 'far fa-compass',
                'parent_menu' => null,
                'status' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 2,
                'menu_name' => 'Bengkel Manager',
                'menu_link' => '/bengkel-manager',
                'menu_icon' => 'far fa-compass',
                'parent_menu' => null,
                'status' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 3,
                'menu_name' => 'WA Marketing Blast',
                'menu_link' => '/wa-marketing-blast',
                'menu_icon' => 'far fa-compass',
                'parent_menu' => null,
                'status' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 4,
                'menu_name' => 'Service Advisor',
                'menu_link' => '/service-advisor',
                'menu_icon' => 'far fa-compass',
                'parent_menu' => null,
                'status' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 5,
                'menu_name' => 'Foreman',
                'menu_link' => '/foreman',
                'menu_icon' => 'far fa-compass',
                'parent_menu' => null,
                'status' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 6,
                'menu_name' => 'User Manager',
                'menu_link' => '/user-management/user-manager',
                'menu_icon' => 'far fa-compass',
                'parent_menu' => 1,
                'status' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 7,
                'menu_name' => 'Customer List',
                'menu_link' => '/user-management/customer-list',
                'menu_icon' => 'far fa-compass',
                'parent_menu' => 1,
                'status' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 8,
                'menu_name' => 'Bengkel Registration',
                'menu_link' => '/bengkel-manager/bengkel-registration',
                'menu_icon' => 'far fa-compass',
                'parent_menu' => 2,
                'status' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 9,
                'menu_name' => 'Bengkel Setting',
                'menu_link' => '/bengkel-manager/bengkel-setting',
                'menu_icon' => 'far fa-compass',
                'parent_menu' => 2,
                'status' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 10,
                'menu_name' => 'Task Setting',
                'menu_link' => '/bengkel-manager/task-setting',
                'menu_icon' => 'far fa-compass',
                'parent_menu' => 2,
                'status' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 11,
                'menu_name' => 'Dashboard WA',
                'menu_link' => '/wa-marketing-blast/dashboard-wa',
                'menu_icon' => 'far fa-compass',
                'parent_menu' => 3,
                'status' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 12,
                'menu_name' => 'Promo Blast',
                'menu_link' => '/wa-marketing-blast/promo-blast',
                'menu_icon' => 'far fa-compass',
                'parent_menu' => 3,
                'status' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 13,
                'menu_name' => 'New Order List',
                'menu_link' => '/service-advisor/new-order-list',
                'menu_icon' => 'far fa-compass',
                'parent_menu' => 4,
                'status' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 14,
                'menu_name' => 'Order InProgress',
                'menu_link' => '/service-advisor/order-inprogress',
                'menu_icon' => 'far fa-compass',
                'parent_menu' => 4,
                'status' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 15,
                'menu_name' => 'Dashboard',
                'menu_link' => '/foreman/dashboard',
                'menu_icon' => 'far fa-compass',
                'parent_menu' => 5,
                'status' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
            [
                'id' => 16,
                'menu_name' => 'Order List',
                'menu_link' => '/foreman/order-list',
                'menu_icon' => 'far fa-compass',
                'parent_menu' => 5,
                'status' => 1,
                'created_at' => new \DateTime('now'),
                'updated_at' => null,
            ],
        ];

        foreach ($menus as $menu) {
            DB::table('menu_masters')->insert($menu);
        }
    }
}
