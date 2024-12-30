<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function allCategory() 
    {
        $categories = Category::latest()->get();
        return view('admin.backend.category.all_category', compact('categories'));
    }

    public function AddCategory() { 
        return view('admin.backend.category.add_category'); 
    }

    public function StoreCategory (Request $request) { 
        if ($request -> file ('image')) {
            $image = $request -> file ('image'); 
            $manager = new ImageManager(new Driver()); 
            $name_gen = hexdec(uniqid()).'.'.
            $image -> getClientOriginalExtension(); 
            $img = $manager -> read ($image); 
            $img -> resize(300, 300) -> save(public_path('upload/category/'.
            $name_gen)); 
            $save_url = 'upload/category'.$name_gen; 

            Category::create([ 
                'category_name' => $request -> cateogry_name, 
                'image' => $save_url, 
            ]);
        }

        $notification = [
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('all.category')->with($notification);
    }
}
