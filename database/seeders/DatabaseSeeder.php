<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypesTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(RestrantsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        //$this->call(ReservesTableSeeder::class);
        //$this->call(FavoritesTableSeeder::class);
    }
}