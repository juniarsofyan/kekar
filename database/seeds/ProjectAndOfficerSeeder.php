<?php

use Illuminate\Database\Seeder;

class ProjectAndOfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Officer Create',
            'Officer View',
            'Officer Update',
            'Officer Delete',
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
