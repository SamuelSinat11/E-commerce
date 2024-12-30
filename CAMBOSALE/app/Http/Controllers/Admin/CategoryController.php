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

    public function EditCategory($id){
        $category = Category::find($id);
        return view('admin.backend.category.edit_category', compact('category'));
    }
     // End Method 

     public function UpdateCategory(Request $request){

        $cat_id = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300,300)->save(public_path('upload/category/'.$name_gen));
            $save_url = 'upload/category/'.$name_gen;

            Category::find($cat_id)->update([
                'category_name' => $request->category_name,
                'image' => $save_url, 
            ]); 
            $notification = array(
                'message' => 'Category Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.category')->with($notification);

        } else {

            Category::find($cat_id)->update([
                'category_name' => $request->category_name, 
            ]); 
            $notification = array(
                'message' => 'Category Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.category')->with($notification);

        }
    }
    // End Method 

    public function DeleteCategory($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);
    
        // Check if the category has an associated image and delete it
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }
    
        // Delete the category record from the database
        $category->delete();
    
        // Prepare the success notification
        $notification = [
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->back()->with($notification);
    }
    
    // End Method 
}




