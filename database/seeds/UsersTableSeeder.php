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

        $adminRole = Role::create(['name' => 'Admin', 'display_name' => 'Administrador']);
        $writerRole = Role::create(['name' => 'Writer', 'display_name' => 'Escritor']);

        $viewPostsPermission   = Permission::create(['name' => 'View posts', 'display_name' => 'Ver publicaciones'  ]);
        $createPostsPermission = Permission::create(['name' => 'Create posts', 'display_name' => 'Crear publicaciones']);
        $updatePostsPermission = Permission::create(['name' => 'Update posts', 'display_name' => 'Actualizar publicaciones']);
        $deletePostsPermission = Permission::create(['name' => 'Delete posts', 'display_name' => 'Eliminar publicaciones']);

        $viewUsersPermission   = Permission::create(['name' => 'View users', 'display_name' => 'Ver usuarios'  ]);
        $createUsersPermission = Permission::create(['name' => 'Create users', 'display_name' => 'Crear usuarios']);
        $updateUsersPermission = Permission::create(['name' => 'Update users', 'display_name' => 'Actualizar usuarios']);
        $deleteUsersPermission = Permission::create(['name' => 'Delete users', 'display_name' => 'Eliminar usuarios']);

        $viewRolesPermission   = Permission::create(['name' => 'View roles', 'display_name' => 'Ver roles'  ]);
        $createRolesPermission = Permission::create(['name' => 'Create roles', 'display_name' => 'Crear roles']);
        $updateRolesPermission = Permission::create(['name' => 'Update roles', 'display_name' => 'Actualizar roles']);
        $deleteRolesPermission = Permission::create(['name' => 'Delete roles', 'display_name' => 'Eliminar roles']);

        $viewPermissionsPermission = Permission::create(['name' => 'View permissions', 'display_name' => 'Ver permisos']);
        $updatePermissionsPermission = Permission::create(['name' => 'Update permissions', 'display_name' => 'Actualizar permisos']);

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
