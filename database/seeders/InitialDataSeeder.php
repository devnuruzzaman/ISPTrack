<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitialDataSeeder extends Seeder
{
    public function run()
    {
        // প্রথমে এডমিন রোল তৈরি করুন
        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // এখন পারমিশনগুলো তৈরি করুন
        $permissions = [
            ['name' => 'billing.approve_payment', 'display_name' => 'Approve payments'],
            ['name' => 'billing.reject_payment', 'display_name' => 'Reject payments'],
            // বাকি পারমিশনগুলো এইভাবে যোগ করুন
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'name' => $permission['name'],
                'display_name' => $permission['display_name'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // এডমিন রোলের আইডি নিন
        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');

        // পারমিশনগুলোকে এডমিন রোলে যুক্ত করুন
        $permissionIds = DB::table('permissions')->pluck('id')->toArray();
        foreach ($permissionIds as $permissionId) {
            DB::table('permission_role')->insert([
                'permission_id' => $permissionId,
                'role_id' => $adminRoleId
            ]);
        }

        // একটা ডিফল্ট এডমিন ইউজার তৈরি করুন
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // এই ইউজারের আইডি নিন এবং এডমিন রোল দিন
        $userId = DB::table('users')->where('email', 'admin@example.com')->value('id');
        DB::table('role_user')->insert([
            'role_id' => $adminRoleId,
            'user_id' => $userId
        ]);
    }
}
