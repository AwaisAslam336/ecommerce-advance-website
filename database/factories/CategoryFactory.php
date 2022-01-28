<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word();
        return [
            'category_name_en' => $name,
            'category_name_urdu' => $name,
            'category_icon' => 'fa fa-id-card',
            'category_slug_en'=> Str::slug($name),
            'category_slug_urdu'=> Str::slug($name),
        ];
    }
}
