<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // TODO: Remove and replace old permissions
        // create permissions
        Permission::create(['name' => 'Операции-с-делами', 'removable' => 0]);
        Permission::create(['name' => 'Просмотр-пользователей', 'removable' => 0]);
        Permission::create(['name' => 'Операции-с-пользователями', 'removable' => 0]);
        Permission::create(['name' => 'Операции-с-диалогами', 'removable' => 0]);
        Permission::create(['name' => 'Операции-с-настройками-сайта', 'removable' => 0]);
        Permission::create(['name' => 'Операции-с-ролями-и-разрешениями', 'removable' => 0]);
        Permission::create(['name' => 'Операции-с-архивом', 'removable' => 0]);
        Permission::create(['name' => 'Просмотр-истории-активности', 'removable' => 0]);
        Permission::create(['name' => 'Операции-с-папками', 'removable' => 0]);
        Permission::create(['name' => 'Доступ-к-базе-связей', 'removable' => 0]);
        Permission::create(['name' => 'Операции-с-группами-пользователей', 'removable' => 0]);

        $role = Role::create(['name' => 'Администратор', 'removable' => 0]);
        $role->givePermissionTo(Permission::all());
        $role = Role::create(['name' => 'Пользователь', 'removable' => 0]);
        $role->givePermissionTo('Просмотр-пользователей');
    }
}
