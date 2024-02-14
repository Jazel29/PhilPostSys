<?php

namespace Database\Factories;
use App\Models\Transmittals;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transmittals>
 */
class TransmittalsFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transmittals::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mailTrackNum' => $this->faker->unique()->randomNumber(8),
            'recieverName' => $this->faker->name,
            'recieverAddress' => $this->faker->address,
            'date' => $this->faker->date(),
        ];
    }
}
