<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PeopleTableSeeder::class);
        $this->call(CustomersTableSeeder::class); 
        $this->call(LicencesTableSeeder::class);
        $this->call(GatewaysTableSeeder::class);
        $this->call(DataTableSeeder::class);
    }
}
