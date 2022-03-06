<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function getAllCategory()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ], [
            'name.required' => 'Category Name Not Valid!!',
            'name.max' => 'Category Name Less Than 255 Character',
        ]);
        // insert with eloquent ORM
        $category = Category::create([
            'name'=>$request->name,
            'user_id'=>Auth::user()->id,
        ]);

//        insert with query
//        $data = array('name' => $validated['name'], 'user_id'=>Auth::user()->id);
//        $validated['user_id'] = Auth::user()->id;
//        DB::table('categories')->insert($validated);
        return Redirect::back()->with('success', 'Category Added Successfully');
//        return redirect(route('all.category'));
//        $message = 'Category Name Not Valid!!';
//        return view('admin.category.index', compact('categories'));
    }
}
