<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ReportByCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Report By Category View'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
