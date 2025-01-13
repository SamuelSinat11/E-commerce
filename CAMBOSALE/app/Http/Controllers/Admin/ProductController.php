<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Intervention\Image\Facades\Image;
use App\Exports\CategoriesExport; 
use Maatwebsite\Excel\Facades\Excel; 
use Intervention\Image\ImageManager; 
use Intervention\Image\Drivers\Gd\Driver; 

class ProductController extends Controller
{
    public function AllProduct() {
        $products = Product::latest()->get();
        return view('admin.backend.product.all_product', compact('products')); 
    }

    public function AddProduct()
    {
        $categories = Category::latest()->get(); 
        return view('admin.backend.product.add_product', compact ('categories'));
    }
}
