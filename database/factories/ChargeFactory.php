<?php

namespace Database\Factories;

use App\Models\Charge;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChargeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Charge::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = (bool)random_int(0, 1);
        if ($type)
            $pinNumber = $this->faker->unique()->numberBetween(1000000000000000, 9999999999999999);
        else
            $pinNumber = $this->faker->name;

        return [
            'pin_number' => $pinNumber,
            'amount' => $this->faker->randomNumber(5),
            'type' => $type,
        ];
    }
}