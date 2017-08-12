<?php

use Illuminate\Database\Seeder;

class LicencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('licences')->insert([
            'date_in' => date('Y-m-d H:i:s'),
            'date_end' => date('Y-m-d H:i:s'),
            'active' => true,
            'customer_id' => 1,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);

        DB::table('licences')->insert([
            'date_in' => date('Y-m-d H:i:s'),
            'date_end' => date('Y-m-d H:i:s'),
            'active' => false,
            'customer_id' => 2,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);        
    }
}
