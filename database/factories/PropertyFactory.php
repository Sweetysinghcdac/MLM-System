<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
      protected $model = Property::class;

    public function definition()
    {
        return [
            // Example fields, adjust according to your properties table
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(50000, 500000),
        ];
    }
}
