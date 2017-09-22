<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Walter Izaguirre',
            'email' => 'wizaguirrel@gmail.com',
            'password' => bcrypt('123456'),
            'role_id' => 1,
            'customer_id' => 1,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Maria Perez',
            'email' => 'maria@gmail.com',
            'password' => bcrypt('123456'),
            'role_id' => 2,
            'customer_id' => 1,            
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);        
    }
}
