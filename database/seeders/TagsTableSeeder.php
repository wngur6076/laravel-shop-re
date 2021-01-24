<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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