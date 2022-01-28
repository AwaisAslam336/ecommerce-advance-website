<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(7)
        ->create()->each(function($category){
            SubCategory::factory(5)
            ->create(['category_id'=>$category->id])->each(function($subcategory){
                SubSubCategory::factory(7)
                ->create(['category_id'=>$subcategory->category_id,'subcategory_id'=>$subcategory->id]);
            });
        });
    }
}
