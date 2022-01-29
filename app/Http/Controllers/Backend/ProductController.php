<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function AddProduct()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.add_product', compact('categories', 'brands'));
    }
    public function StoreProduct(Request $request)
    {

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/' . $name_gen);
        $save_url = 'upload/products/thumbnail/' . $name_gen;

        $product_id =Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_urdu' => $request->product_name_urdu,
            'product_slug_en' => strtolower(str_replace('', '-', $request->product_name_en)),
            'product_slug_urdu' => str_replace('', '-', $request->product_name_urdu),
            'product_code' => $request->product_code,

            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_urdu' => $request->product_tags_urdu,
            'product_size_en' => $request->product_size_en,
            'product_size_urdu' => $request->product_size_urdu,
            'product_color_en' => $request->product_color_en,
            'product_color_urdu' => $request->brand_id,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_urdu' => $request->short_descp_urdu,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_urdu' => $request->long_descp_urdu,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'product_thumbnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
        /////////////////////////////////////////////////////
        $images = $request->file('multi_Img');
        foreach ($images as $img) {
            $name_make = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi_img/' . $name_make);
            $store_url = 'upload/products/multi_img/' . $name_make;

            MultiImg::insert([
                'product_id'=> $product_id,
                'photo_name'=> $store_url,
                'created_at'=> Carbon::now(),
            ]);
        }
        //////////////////////////////////////////////////////

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manage_product')->with($notification);

    }
    public function ManageProduct(){
        $products = Product::latest()->get();
        return view('backend.product.view_product',compact('products'));
    }
}
