<?php
namespace Database\Factories;

use App\Models\AddresseeList;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AddresseeListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AddresseeList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'abbrev' => Str::random(3),
            'name_primary' => $this->faker->name,
            'name_secondary' => $this->faker->name,
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'zip' => $this->faker->postcode, // Include the zip field
            'province' => $this->faker->state,
            // Add other fields and their default values here
        ];
    }
}