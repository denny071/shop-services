<?php

namespace Database\Seeders;

use Dcat\Admin\Models\{
    Administrator,
    Role,
    Permission,
    Menu,

};
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createdAt = date('Y-m-d H:i:s');

        // create a user.
        Administrator::truncate();
        Administrator::create([
            'username'   => 'admin',
            'password'   => bcrypt('admin'),
            'name'       => 'Administrator',
            'created_at' => $createdAt,
        ]);

        // create a role.
        Role::truncate();
        Role::create([
            'name'       => 'Administrator',
            'slug'       => Role::ADMINISTRATOR,
            'created_at' => $createdAt,
        ]);

        // add role to user.
        Administrator::first()->roles()->save(Role::first());

        //create a permission
        Permission::truncate();
        Permission::insert([
            [
                'id'          => 1,
                'name'        => 'Auth management',
                'slug'        => 'auth-management',
                'http_method' => '',
                'http_path'   => '',
                'parent_id'   => 0,
                'order'       => 1,
                'created_at'  => $createdAt,
            ],
            [
                'id'          => 2,
                'name'        => 'Users',
                'slug'        => 'users',
                'http_method' => '',
                'http_path'   => '/auth/users*',
                'parent_id'   => 1,
                'order'       => 2,
                'created_at'  => $createdAt,
            ],
            [
                'id'          => 3,
                'name'        => 'Roles',
                'slug'        => 'roles',
                'http_method' => '',
                'http_path'   => '/auth/roles*',
                'parent_id'   => 1,
                'order'       => 3,
                'created_at'  => $createdAt,
            ],
            [
                'id'          => 4,
                'name'        => 'Permissions',
                'slug'        => 'permissions',
                'http_method' => '',
                'http_path'   => '/auth/permissions*',
                'parent_id'   => 1,
                'order'       => 4,
                'created_at'  => $createdAt,
            ],
            [
                'id'          => 5,
                'name'        => 'Menu',
                'slug'        => 'menu',
                'http_method' => '',
                'http_path'   => '/auth/menu*',
                'parent_id'   => 1,
                'order'       => 5,
                'created_at'  => $createdAt,
            ],
            [
                'id'          => 6,
                'name'        => 'Extension',
                'slug'        => 'extension',
                'http_method' => '',
                'http_path'   => '/auth/extensions*',
                'parent_id'   => 1,
                'order'       => 6,
                'created_at'  => $createdAt,
            ],
        ]);

//        Role::first()->permissions()->save(Permission::first());

        // add default menus.
        Menu::truncate();
        Menu::insert([
            [
                'parent_id'     => 0,
                'order'         => 1,
                'title'         => 'Index',
                'icon'          => '',
                'uri'           => '/',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 0,
                'order'         => 2,
                'title'         => '用户管理',
                'icon'          => '',
                'uri'           => '/users',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 0,
                'order'         => 3,
                'title'         => '商品管理',
                'icon'          => '',
                'uri'           => '/products',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 0,
                'order'         => 4,
                'title'         => '订单关联',
                'icon'          => '',
                'uri'           => '/orders',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 0,
                'order'         => 5,
                'title'         => '优惠券管理',
                'icon'          => '',
                'uri'           => '/coupon',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 0,
                'order'         => 6,
                'title'         => '类目管理',
                'icon'          => '',
                'uri'           => '/catalog',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 3,
                'order'         => 13,
                'title'         => '众筹商品',
                'icon'          => '',
                'uri'           => '/crowdfunding_products',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 3,
                'order'         => 14,
                'title'         => '普通商品',
                'icon'          => '',
                'uri'           => '/products',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 3,
                'order'         => 15,
                'title'         => '秒杀商品',
                'icon'          => '',
                'uri'           => '/seckill_products',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 0,
                'order'         => 98,
                'title'         => 'Admin',
                'icon'          => 'feather icon-settings',
                'uri'           => '',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 10,
                'order'         => 3,
                'title'         => 'Users',
                'icon'          => '',
                'uri'           => 'auth/users',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 10,
                'order'         => 4,
                'title'         => 'Roles',
                'icon'          => '',
                'uri'           => 'auth/roles',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 10,
                'order'         => 5,
                'title'         => 'Permission',
                'icon'          => '',
                'uri'           => 'auth/permissions',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 10,
                'order'         => 6,
                'title'         => 'Menu',
                'icon'          => '',
                'uri'           => 'auth/menu',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 10,
                'order'         => 7,
                'title'         => 'Operation log',
                'icon'          => '',
                'uri'           => 'auth/logs',
                'created_at'    => $createdAt,
            ],
        ]);

        (new Menu())->flushCache();
    }
}