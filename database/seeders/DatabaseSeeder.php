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
        \App\Models\User::factory(8)->create()->each(function($u) {
            if ($u->role == 2) {
                $u->products()
                    ->saveMany(
                        \App\Models\Product::factory(rand(1, 5))->make()
                    );
            }
        });
    }
}