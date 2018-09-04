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
             app()['cache']->forget('spatie.permission.cache');


            // create permissions

            //user permissions
            Permission::create(['name' => 'create user']);
            Permission::create(['name' => 'edit user']);
            Permission::create(['name' => 'delete user']);

            //shop permissions
            Permission::create(['name' => 'create product']);
            Permission::create(['name' => 'edit product']);
            Permission::create(['name' => 'delete product']);
            Permission::create(['name' => 'buy product']);
            // Permission::create(['name' => 'own shop']);

            // create roles and assign created permissions

            $role = Role::create(['name' => 'super-admin']); //Super Admin
            $role->givePermissionTo(Permission::all());

            $role = Role::create(['name' => 'admin']); // Admin
            $role->givePermissionTo([
                'create user',
                'edit user',
                'delete user',
                //Products
                'create product',
                'edit product',
                'delete product'
                ]);

            $role = Role::create(['name' => 'shopkeeper']); // Usuario Vende
            $role->givePermissionTo([
                'create product',
                'edit product',
                'delete product',
                'buy product'
            ]);            

            $role = Role::create(['name' => 'client']); // Usuario Regular 
            $role->givePermissionTo([
                'buy product'
            ]);
    }
}
