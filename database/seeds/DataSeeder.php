<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\User;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('rahasia123'),
        ]);
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        DB::table('model_has_roles')->insert([
            'role_id' => '1',
            'model_type' => 'App\User',
            'model_id' => '1'
        ]);
    }
}
