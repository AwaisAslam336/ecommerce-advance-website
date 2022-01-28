<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubSubCategoryFactory extends Factory
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
            'subsubcategory_name_en' => $name,
            'subsubcategory_name_urdu' => $name,
            'subsubcategory_slug_en'=> Str::slug($name),
            'subsubcategory_slug_urdu'=> Str::slug($name),
        ];
    }
}
