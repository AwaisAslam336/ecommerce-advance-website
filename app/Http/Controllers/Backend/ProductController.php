<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
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

        $product_id = Product::insertGetId([
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
                'product_id' => $product_id,
                'photo_name' => $store_url,
                'created_at' => Carbon::now(),
            ]);
        }
        //////////////////////////////////////////////////////

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manage_product')->with($notification);
    }
    public function ManageProduct()
    {
        $products = Product::latest()->get();
        return view('backend.product.view_product', compact('products'));
    }

    public function EditProduct($id)
    {
        $multiImages = MultiImg::where('product_id', $id)->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $brands = Brand::latest()->get();
        $product = Product::findOrFail($id);

        return view('backend.product.edit_product', compact('categories', 'subcategories', 'subsubcategories', 'brands', 'product', 'multiImages'));
    }
    public function UpdateProductData(Request $request)
    {
        $product_id = $request->id;
        Product::findOrFail($product_id)->update([
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
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Updated without Image',
            'alert-type' => 'success'
        );
        return redirect()->route('manage_product')->with($notification);
    }

    public function UpdateProductImage(Request $request)
    {
        $imgs = $request->multi_img;
        foreach ($imgs as $id => $img) {

            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);

            $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi_img/' . $name_gen);
            $save_url = 'upload/products/multi_img/' . $name_gen;

            MultiImg::where('id',$id)->update([
                'photo_name' => $save_url,
                'updated_at' => Carbon::now()
            ]);

        }

        $notification = array(
            'message' => 'Product Image Updated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function UpdateProductThumbnail(Request $request){
        $prod_id = $request->id;
        $oldImg = $request->old_img;
        unlink($oldImg);

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/' . $name_gen);
        $save_url = 'upload/products/thumbnail/' . $name_gen;

        Product::findOrFail($prod_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Product Thumbnail Updated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function DeleteMultiImage($id){

        $oldImg = MultiImg::findOrFail($id);
        unlink($oldImg->photo_name);
        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Image deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
