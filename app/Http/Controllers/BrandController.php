<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    //

    public function getAllBrand(){
        $brand = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brand'));
    }

    public function editBrand($id){
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function updateBrand(Request $request,$id){
        $validated = $request->validate([
            'name' => 'required|unique:brands|max:255',
        ], [
            'name.required' => 'Brand Name Not Valid!!',
            'name.max' => 'Brand Name Less Than 255 Character',
        ]);
        $old_image = $request->old_image;
        $brand_image = $request->file('image');
        if($brand_image){
            $image_id = hexdec(uniqid());
            $image_ext = strtolower($brand_image->getClientOriginalExtension());
            $image_name = $image_id.'.'.$image_ext;
            $upload_path = 'image/brand/';
            $last_image = $upload_path.$image_name;
            $brand_image->move($upload_path,$image_name);
            unlink($old_image);
            Brand::find($id)->update([
                'name'=>$request->name,
                'image'=>$last_image,
            ]);
        } else {
            Brand::find($id)->update([
                'name'=>$request->name
            ]);
        }

        return Redirect::route('all.brand')->with('success', 'Brand Updated Successfully');
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
