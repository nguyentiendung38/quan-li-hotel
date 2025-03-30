<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Tạo các quyền cơ bản
        $permissions = [
            'user-list' => 'Quản lý danh sách người dùng',
            'user-create' => 'Thêm người dùng',
            'user-edit' => 'Sửa người dùng',
            'user-delete' => 'Xóa người dùng',
            'role-list' => 'Quản lý vai trò',
            'role-create' => 'Thêm vai trò',
            'role-edit' => 'Sửa vai trò',
            'role-delete' => 'Xóa vai trò',
            // Thêm các quyền khác tùy nhu cầu
        ];

        foreach ($permissions as $name => $display_name) {
            Permission::firstOrCreate(
                ['name' => $name],
                [
                    'display_name' => $display_name,
                    'group_permission_id' => 1, // Thay đổi giá trị này nếu cần
                ]
            );
        }
        

        // Tạo vai trò admin
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            [
                'display_name' => 'Administrator',
                'description' => 'Quản trị viên hệ thống'
            ]
        );

        // Gán tất cả quyền cho vai trò admin
        $adminRole->permissions()->sync(Permission::all());

        // Tạo tài khoản admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123456789'),
                'phone' => '0123456789',
                'address' => 'Huế',
                'status' => 1
            ]
        );

        // Gán vai trò admin
        if (!$admin->hasRole('admin')) {
            $admin->attachRole($adminRole);
        }
    }
}
