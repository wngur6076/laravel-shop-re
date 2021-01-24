<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsersProductsPriceListTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersProductsPriceListTableSeeder::class,
            FavoritesTableSeeder::class,
            TagsTableSeeder::class,
        ]);
    }
}