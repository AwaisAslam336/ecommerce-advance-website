<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{

    public function AllCategories()
    {
        $categories = Category::latest()->get();
        return view('backend.category.all_categories', compact('categories'));
    }
    public function StoreCategory(Request $request)
    {
        $request->validate([
            'category_name_en' => 'required',
            'category_name_urdu' => 'required',
            'category_icon' => 'required',
        ], [
            'category_name_en.required' => 'Please Input Category Name in English',
            'category_name_urdu.required' => 'Please Input Category Name in Urdu',

        ]);

        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_urdu' => $request->category_name_urdu,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_urdu' => strtolower(str_replace(' ', '-', $request->category_name_urdu)),
            'category_icon' => $request->category_icon,
        ]);
        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.edit_category', compact('category'));
    }
    public function UpdateCategory(Request $request)
    {
        $category_id = $request->id;

        Category::findOrFail($category_id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_urdu' => $request->category_name_urdu,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_urdu' => strtolower(str_replace(' ', '-', $request->category_name_urdu)),
            'category_icon' => $request->category_icon,
        ]);
        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all_categories')->with($notification);
    }

    public function DeleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->back();
    }
}
