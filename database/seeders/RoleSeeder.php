<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Core\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::get();
        if($roles->isEmpty()){
            Role::insert(
                [
                    ['name' => 'admin', 'description' => 'Full permission!'],
                    ['user' => 'user', 'description' => 'Normal permission!'],
                ]
            );
        }
    }
}
