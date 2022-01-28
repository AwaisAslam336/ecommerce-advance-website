<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubCategoryFactory extends Factory
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
            'subcategory_name_en' => $name,
            'subcategory_name_urdu' => $name,
            'subcategory_slug_en'=> Str::slug($name),
            'subcategory_slug_urdu'=> Str::slug($name),
        ];
    }
}
