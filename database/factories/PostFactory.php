<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->realText();
        return [
            'title' => $title,
            'summary' => $this->faker->paragraph(2),
            'description' => $this->faker->paragraph(5),
            'is_published' => $this->faker->boolean(65),
            'image' => $this->faker->imageUrl(400, 300),
            'trash' => $this->faker->boolean(35)
        ];
    }
}
