<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Contact::class;
    public function definition()
    {
        return [
            'last_name' => $this->faker->lastname(),
            'first_name' => $this->faker->firstname(),
            'gender' => $this->faker->numberBetween(1,3),
            'email' => $this->faker->unique()->safeEmail(),
            'tel' => $this->faker->numerify('0##########'),
            'address' => $this->faker->city(),
            'building' => $this->faker->optional()->word(),
            'category_id' => $this->faker->numberBetween(1,5),
            'detail' => $this->faker->text(120),
        ];
    }
}
