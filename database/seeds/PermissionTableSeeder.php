<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Role Create',
            'Role View',
            'Role Update',
            'Role Delete',
            'Permission Create',
            'Permission View',
            'Permission Update',
            'Permission Delete',
            'User Create',
            'User View',
            'User Update',
            'User Delete',
            'Category Create',
            'Category View',
            'Category Update',
            'Category Delete',
            'Component Create',
            'Component View',
            'Component Update',
            'Component Delete',
            'Customer Create',
            'Customer View',
            'Customer Update',
            'Customer Delete',
            'Inventory Create',
            'Inventory View',
            'Inventory Update',
            'Inventory Delete',
            'Material Create',
            'Material View',
            'Material Update',
            'Material Delete',
            'Process Create',
            'Process View',
            'Process Update',
            'Process Delete',
            'Project Create',
            'Project View',
            'Project Update',
            'Project Delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
