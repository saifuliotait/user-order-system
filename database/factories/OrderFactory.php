<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            'order_number' => $this->faker->unique()->uuid,
            'user_id' => $this->randomizeUsers(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'unit_price' => $this->faker->randomFloat(2, 10, 100),
            'discount' => $this->faker->randomFloat(2, 0, 20),
            'total_amount' => function (array $attributes) {
                return $attributes['quantity'] * ($attributes['unit_price'] - $attributes['discount']);
            },
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'declined']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function getUsers()
    {
        return \App\Models\User::pluck('id')->toArray();
    }

    public function randomizeUsers()
    {
        $users = $this->getUsers();
        $randomIndex = array_rand($users);

        return $users[$randomIndex];
    }
}
