<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'brand_name_en' => $this->faker->word(),
            'brand_name_urdu' => $this->faker->word(),
            'brand_image' => 'upload/no_image.jpg',
            'brand_slug_en'=> strtolower(str_replace(' ', '-', $this->faker->word())),
            'brand_slug_urdu'=> strtolower(str_replace(' ', '-', $this->faker->word()))
        ];
    }
}
