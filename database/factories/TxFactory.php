<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tx>
 */
class TxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fn() => mt_rand(1, 10) > 5 ? 'qris' : 'cash',
            'name' => $this->faker->firstName(),
            'phone' => $this->faker->phoneNumber(),
            'amount' => $this->faker->numberBetween(10000, 500000),
            'date' => $this->generateRandomDate(),
        ];
    }

    private function generateRandomDate()
    {
        // Get the current date
        $currentDate = Carbon::now();

        // Generate a random number of days between -30 and +30
        $randomDays = mt_rand(-30, 30);

        // Add the random number of days to the current date
        $randomDate = $currentDate->addDays($randomDays);

        // Format the date as d-m-Y
        return $randomDate->format('d-m-Y');
    }

}
