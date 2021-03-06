<?php

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(CountriesSeeder::class);
        $this->call(StatesSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
