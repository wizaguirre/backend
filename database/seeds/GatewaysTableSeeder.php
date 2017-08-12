<?php

use Illuminate\Database\Seeder;

class GatewaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gateways')->insert([
            'name' => 'Puerta Principal, Norte',
            'description' => 'Puerta de acceso, sección niños',
            'customer_id' => 1,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);

        DB::table('gateways')->insert([
            'name' => 'Puerta Trasera, SurOeste',
            'description' => 'Puerta de acceso, sección muebles',
            'customer_id' => 1,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);

        DB::table('gateways')->insert([
            'name' => 'Acceso Principal',
            'description' => 'Acceso frente al parqueo principal',
            'customer_id' => 2,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);

        DB::table('gateways')->insert([
            'name' => 'Acceso Trasero',
            'description' => 'Acceso por el centro comercial',
            'customer_id' => 2,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);              
    }
}
