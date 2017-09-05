<?php

use Illuminate\Database\Seeder;

class DataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('data')->insert([
            'date' => date('Y-m-d'),
            'datetime' => date('Y-m-d H:i:s'),
            'count' => 1,
            'customer_id' => 1,
            'gateway_id' => 1,
            'people_id' => 1,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);
    }
}
