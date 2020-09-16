<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        Permission::truncate();
        User::truncate();

        $adminRole = Role::create(['name' => 'Admin']);
        $writerRole = Role::create(['name' => 'Writer']);

        $viewPostsPermission = Permission::create(['name' => 'View posts']);
        $createPostsPermission = Permission::create(['name' => 'Create posts']);
        $updatePostsPermission = Permission::create(['name' => 'Update posts']);
        $deletePostsPermission = Permission::create(['name' => 'Delete posts']);

        $viewUsersPermission = Permission::create(['name' => 'View users']);
        $createUsersPermission = Permission::create(['name' => 'Create users']);
        $updateUsersPermission = Permission::create(['name' => 'Update users']);
        $deleteUsersPermission = Permission::create(['name' => 'Delete users']);

        $updateRolesPermission = Permission::create(['name' => 'Update roles']);

        $admin = new User;
        $admin->name = 'Miguel';
        $admin->email = 'mfigaredo@gmail.com';
        $admin->email_verified_at = date('Y-m-d H:i:s');
        $admin->password = ('test123');
        $admin->remember_token = Str::random(32);
        $admin->save();
        $admin->assignRole($adminRole);

        $writer = new User;
        $writer->name = 'Star';
        $writer->email = 'star@somegmail.com';
        $writer->email_verified_at = date('Y-m-d H:i:s');
        $writer->password = ('test123');
        $writer->remember_token = Str::random(32);
        $writer->save();
        $writer->assignRole($writerRole);

    }
}
