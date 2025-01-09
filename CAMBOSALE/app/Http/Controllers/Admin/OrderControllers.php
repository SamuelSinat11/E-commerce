<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders; 

class OrderControllers extends Controller
{


    // This Method will show Order Page 
    public function index() { 
        
    }

    // This method will show create Page 
    public function create() { 
        return view('admin.backend.orders.create'); 
    }

    public function store() { 
        
    }

    public function edit() { 
        
    }

    public function update() { 
        

    }

    public function destroy() { 
        
    }

}
