<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CardWorkDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Card Work View',
            'Card Work Create',
            'Card Work Update',
            'Card Work Delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
