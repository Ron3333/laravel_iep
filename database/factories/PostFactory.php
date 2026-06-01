<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $name = $this->faker->name();
        $name = $this->faker->sentence;
        return [
            'title' => $name,
            'slug' => str($name)->slug(),
            'content' => $this->faker->paragraphs(20, true),
            'description' => $this->faker->sentence(10),
            'category_id' => $this->faker->randomElement([1, 2, 3,54,55,56,57,58,59,60 ]),
            'posted' => $this->faker->randomElement(['yes', 'not']),
            'image' => $this->faker->imageUrl()
        ];

         
    }
}
