<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function AllBrands()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.all_brands', compact('brands'));
    }
    public function StoreBrand(Request $request)
    {
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_urdu' => 'required',
            'brand_image' => 'required',
        ], [
            'brand_name_en.required' => 'Please Input Brand Name in English',
            'brand_name_urdu.required' => 'Please Input Brand Name in Urdu',

        ]);

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/brand_images/' . $name_gen);
        $save_url = 'upload/brand_images/' . $name_gen;

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_urdu' => $request->brand_name_urdu,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_slug_urdu' => strtolower(str_replace(' ', '-', $request->brand_name_urdu)),
            'brand_image' => $save_url,
        ]);
        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.edit_brand', compact('brand'));
    }
    public function UpdateBrand(Request $request)
    {
        $brand_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('brand_image')) {
            unlink($old_img);
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/brand_images/' . $name_gen);
            $save_url = 'upload/brand_images/' . $name_gen;

            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_urdu' => $request->brand_name_urdu,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_urdu' => strtolower(str_replace(' ', '-', $request->brand_name_urdu)),
                'brand_image' => $save_url,
            ]);
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('all_brands')->with($notification);
        }
        else{
            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_urdu' => $request->brand_name_urdu,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_urdu' => strtolower(str_replace(' ', '-', $request->brand_name_urdu)),
            ]);
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('all_brands')->with($notification);
        }
    }

    public function DeleteBrand($id){
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);
        Brand::findOrFail($id)->delete();

        return redirect()->back();
    }

}
