<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\ImageManagerStatic;

class CategoryController extends Controller
{
    /** * Display all categories.
     */
    public function allCategory() 
    {
        $categories = Category::latest()->get();
        return view('admin.backend.category.all_category', compact('categories'));
    }

    /**
     * Show the form to add a new category.
     */
    public function AddCategory() 
    {
        return view('admin.backend.category.add_category'); 
    }

    /**
     * Store a new category.
     */
    public function StoreCategory(Request $request) 
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $save_url = null;

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image_path = public_path('upload/category/' . $name_gen);

            // Resize and save the image
            Image::make($image)->resize(300, 300)->save($image_path);
            $save_url = 'upload/category/' . $name_gen;
        }

        Category::create([
            'category_name' => $request->category_name,
            'image' => $save_url,
        ]);

        return redirect()->route('all.category')->with([
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success',
        ]);
    }

    /**
     * Show the form to edit a category.
     */
    public function EditCategory($id) 
    {
        $category = Category::findOrFail($id); 
        return view('admin.backend.category.edit_category', compact('category')); 
    }

    /**
     * Update an existing category.
     */
    public function UpdateCategory(Request $request) 
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $category = Category::findOrFail($request->id);

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image_path = public_path('upload/category/' . $name_gen);

            // Resize and save the image
            Image::make($image)->resize(300, 300)->save($image_path);
            $save_url = 'upload/category/' . $name_gen;

            // Delete the old image if exists
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $category->update([
                'category_name' => $request->category_name,
                'image' => $save_url,
            ]);
        } else {
            $category->update([
                'category_name' => $request->category_name,
            ]);
        }

        return redirect()->route('all.category')->with([
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success',
        ]);
    }
}




