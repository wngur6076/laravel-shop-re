<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersProductsPriceListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
                    )->each(function($p) {
                    $p->priceList()->saveMany(\App\Models\Price::factory(rand(1, 3))->make());
                });
            }
        });
    }
}