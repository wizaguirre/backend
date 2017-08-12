<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'name' => 'Industrias Acme',
            'contact' => 'Jhon Doe',
            'email' => 'jhon@acme.com',
            'phone' => '22334455',
            'address' => 'Suite #10, Edificio Acme, Managua, Nicaragua',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);

        DB::table('customers')->insert([
            'name' => 'Soluciones Integrales',
            'contact' => 'Juan Gonzalez',
            'email' => 'juan@correo.com',
            'phone' => '88866779',
            'address' => 'KM 8 Carretera a Masaya, Managua, Nicaragua',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);        
    }
}
