<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'name' => $this->faker->name,
            'contacts' => [
                [
                    'type' => $this->faker->randomElement(['telefone', 'whatsapp']),
                    'value' => $this->faker->phoneNumber,
                ],
                [
                    'type' => 'email',
                    'value' => $this->faker->email,
                ],
            ],
        ];
    }
}
