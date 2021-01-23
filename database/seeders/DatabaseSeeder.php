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
                    )->each(function($p) {
                    $p->priceList()->saveMany(\App\Models\Price::factory(rand(1, 3))->make());
                });
            }
        });

        // 태그 생성
        $tags = config('project.tags');
        foreach($tags as $slug => $name) {
            \App\Models\Tag::create([
                'name' => $name,
                'slug' => \Str::slug($slug)
            ]);
        }
        $faker = \Faker\Factory::create();
        $products = \App\Models\Product::all();
        $tags = \App\Models\Tag::all();

        foreach($products as $product) {
            $product->tags()->sync(
                $faker->randomElements(
                    $tags->pluck('id')->toArray(), rand(1, 3)
                )
            );
        }
    }
}