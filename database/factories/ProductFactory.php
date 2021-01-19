<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => rtrim($this->faker->sentence(rand(5, 10)), "."),
            'body' => $this->faker->paragraphs(rand(3, 7), true),
            'price' => $this->faker->randomNumber(4),
            // 'image' => basename($this->faker->image(public_path('files', 500, 450))),
            'image' => basename(public_path('files', 500, 450) . '/apple.jpg'),
        ];
    }
}