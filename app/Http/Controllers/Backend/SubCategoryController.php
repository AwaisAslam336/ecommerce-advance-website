<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function AllSubCategories()
    {
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategories = SubCategory::latest()->get();
        return view('backend.subcategory.all_subcategories', compact('subcategories','categories'));
    }

    public function StoreSubCategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_urdu' => 'required',
        ], [
            'subcategory_name_en.required' => 'Please Input Category Name in English',
            'subcategory_name_urdu.required' => 'Please Input Category Name in Urdu',

        ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_urdu' => $request->subcategory_name_urdu,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_urdu' => strtolower(str_replace(' ', '-', $request->subcategory_name_urdu)),
        ]);
        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditSubCategory($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('backend.subcategory.edit_subcategory', compact('subcategory','categories'));
    }
    public function UpdateSubCategory(Request $request)
    {
        $subcategory_id = $request->id;

        SubCategory::findOrFail($subcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_urdu' => $request->subcategory_name_urdu,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_urdu' => strtolower(str_replace(' ', '-', $request->subcategory_name_urdu)),
        ]);
        $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all_subcategories')->with($notification);
    }

    public function DeleteSubCategory($id)
    {
        SubCategory::findOrFail($id)->delete();
        return redirect()->back();
    }
}
