<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\Facades\Image;
use App\Exports\CategoriesExport; 
use Maatwebsite\Excel\Facades\Excel; 

class CategoryController extends Controller
{
    public function allCategory()
    {
        $categories = Category::latest()->get();
        return view('admin.backend.category.all_category', compact('categories'));
    }

    public function AddCategory()
    {
        return view('admin.backend.category.add_category');
    }

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
            // Image::make($image)->resize(300, 300)->save($image_path);
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

    public function EditCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.backend.category.edit_category', compact('category'));
    }

    public function UpdateCategory(Request $request)
    {
        $cat_id = $request->id;

        $category = Category::findOrFail($cat_id);

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image_path = public_path('upload/category/' . $name_gen);

            // Resize and save the new image
            // Image::make($image)->resize(300, 300)->save($image_path);
            $save_url = 'upload/category/' . $name_gen;

            // Delete the old image if it exists
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

    public function DeleteCategory($id)
    {
        $category = Category::findOrFail($id);

        // Delete the associated image if it exists
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }

        $category->delete();

        return redirect()->back()->with([
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success',
        ]);
    }

    public function filter(Request $request) {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
    
        // Validate input dates
        if (!$start_date || !$end_date) {
            return redirect()->back()->with('error', 'Start and End dates are required.');
        }
    
        // Query categories based on the date range
        $categories = Category::whereDate('created_at', '>=', $start_date)
                              ->whereDate('created_at', '<=', $end_date)
                              ->get();
    
        return view('admin.backend.category.all_category', compact('categories'));
    }

    public function export() 
    {
        $filename = "categories.xlsx"; 
        return Excel::download(new CategoryExport, $filename); 
    }

}
