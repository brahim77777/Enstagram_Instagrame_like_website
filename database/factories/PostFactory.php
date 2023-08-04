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
    public function definition(): array
    {
        return [
            //
            'image' =>'posts/'. fake()->randomElement(['img2','img1' , 'img3']) .'.png' , 
            'description' => fake()->sentence() ,
            'slug' => fake()->regexify('[A-Za-z0-9]{10}'),
            'user_id' =>1,


        ];
    }
}
