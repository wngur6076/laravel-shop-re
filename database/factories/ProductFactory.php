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
        if (random_int(0, 1)) {
            $video = 'https://youtu.be/nfQzseYn-ow';
            $image = basename(public_path('files', 500, 450) . '/apple.jpg');
        } else {
            $video = null;
            $image = basename(public_path('files', 500, 450) . '/apple.jpg');
        }
        return [
            'title' => rtrim($this->faker->sentence(rand(5, 10)), "."),
            'body' => $this->faker->paragraphs(rand(3, 7), true),
            // 'image' => basename($this->faker->image(public_path('files', 500, 450))),
            'file_link' => 'https://drive.google.com/file/d/1LYozTVCPd5HMAxn0Ypy0M1fu7I6b3GtW/view?usp=sharing',
            'video' => $video,
            'image' => $image,
        ];
    }
}
