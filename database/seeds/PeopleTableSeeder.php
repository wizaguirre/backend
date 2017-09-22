<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('people')->insert([
            'gender' => 'Masculino',
            'name' => 'Anciano Varón',
            'description' => 'Sexo masculino, rango de edad entre 60 y 90 años',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);

        DB::table('people')->insert([
            'gender' => 'Femenino',
            'name' => 'Anciano Mujer',
            'description' => 'Sexo masculino, rango de edad entre 60 y 90 años',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);        

        DB::table('people')->insert([
            'gender' => 'Masculino',
            'name' => 'Adulto Varón',
            'description' => 'Sexo masculino, rango de edad entre 30 y 60 años',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);

        DB::table('people')->insert([
            'gender' => 'Femenino',
            'name' => 'Adulto Mujer',
            'description' => 'Sexo femenino, rango de edad entre 30 y 60 años',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);

        DB::table('people')->insert([
            'gender' => 'Masculino',
            'name' => 'Adolescente Varón',
            'description' => 'Sexo masculino, rango de edad entre 16 y 29 años',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);

        DB::table('people')->insert([
            'gender' => 'Femenino',
            'name' => 'Adolescente Mujer',
            'description' => 'Sexo femenino, rango de edad entre 16 y 29 años',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);

        DB::table('people')->insert([
            'gender' => 'Masculino',
            'name' => 'Niño',
            'description' => 'Sexo masculino, rango de edad entre 4 y 14 años',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);

        DB::table('people')->insert([
            'gender' => 'Femenino',
            'name' => 'Niña',
            'description' => 'Sexo femenino, rango de edad entre 4 y 14 años',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at'=> date('Y-m-d H:i:s')
        ]);                              
    }
}
