<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $address = ['Yangon','Mandalay','Bago','Mawlamyine','Taunggyi','Pyin Oo Lwin','Inn Lay'];
        return [
            'title' => $this->faker->sentence(8),
            'description' => $this->faker->text(1000),
            'price' => rand(2000,50000),
            'address'=>$address[array_rand($address)],
            'rating'=>rand(0,5)
        ];

    }
}
