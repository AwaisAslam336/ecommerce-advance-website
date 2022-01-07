<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class SubSubCategoryController extends Controller
{
    public function AllSubSubCategories()
    {
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subsubcategories = SubSubCategory::latest()->get();
        return view('backend.subsubcategory.all_subsubcategories', compact('subsubcategories','categories'));
    }

    public function StoreSubSubCategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_urdu' => 'required',
        ], [
            'subsubcategory_name_en.required' => 'Please Input Category Name in English',
            'subsubcategory_name_urdu.required' => 'Please Input Category Name in Urdu',

        ]);

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_urdu' => $request->subsubcategory_name_urdu,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_urdu' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_urdu)),
        ]);
        $notification = array(
            'message' => 'Sub-SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditSubSubCategory($id)
    {
        $subsubcategory = SubSubCategory::findOrFail($id);
        $subcategories = SubCategory::orderBy('subcategory_name_en','ASC')->get();
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('backend.subsubcategory.edit_subsubcategory', compact('subsubcategory','subcategories','categories'));
    }
    public function UpdateSubSubCategory(Request $request)
    {
        $subcategory_id = $request->id;

        SubSubCategory::findOrFail($subcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_urdu' => $request->subsubcategory_name_urdu,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_urdu' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_urdu)),
        ]);
        $notification = array(
            'message' => 'Sub-SubCategory Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all_subsubcategories')->with($notification);
    }

    public function DeleteSubSubCategory($id)
    {
        SubSubCategory::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }
}
