<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //

    public function getAllBrand(){
        $brand = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brand'));
    }

    public function storeBrand(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:brands|max:255',
            'image' => 'required|mimes:jpg.jpeg,png',
        ], [
            'name.required' => 'Brand Name Not Valid!!',
            'name.max' => 'Brand Name Less Than 255 Character',
        ]);
        $brand_image = $request->file('image');
        $image_id = hexdec(uniqid());
        $image_ext = strtolower($brand_image->getClientOriginalExtension());
        $image_name = $image_id.'.'.$image_ext;
        $upload_path = 'image/brand/';
        $last_image = $upload_path.$image_name;
        $brand_image->move($upload_path,$image_name);
        $brand = Brand::create([
            'name'=>$request->name,
            'image'=>$last_image,
        ]);
        return Redirect()->back()->with('success', 'Brand Added Successfully');
    }

}
