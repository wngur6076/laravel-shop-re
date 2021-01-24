<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('favorites')->delete();
        $users = User::pluck('id')->all();
        $numberOfUsers = count($users);

        foreach (Product::all() as $product) {
            for ($i = 0; $i < rand(0, $numberOfUsers); $i++) {
                $user = $users[$i];

                $product->favorites()->attach($user);
            }
        }
    }
}