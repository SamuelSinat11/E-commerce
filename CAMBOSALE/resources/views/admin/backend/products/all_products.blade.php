@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <!-- Start Page Title -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="text-dark font-weight-bold">Product Management</h4>
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreen"> Add Products </button>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <!-- Products Table -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 text-white">All Products</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-hover table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Product_Name</th>
                                        <th>Product_Description</th>
                                        <th>Product_Image</th>
                                        <th>Price </th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->Product_Name}}</td>
                                        <td>{{ $item->Product_Description}}</td>
                                        <td>{{ $item->Price}}</td>
                                        <td><img src="{{ asset($item->Product_Image) }}" alt="" style="width: 70px; height:40px;"></td>
                                        <td class="text-center">
                                            <a href="{{ route('edit.category', $item->id) }}" class="btn btn-primary btn-sm me-2">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="{{ route('delete.category', $item->id) }}" id="delete" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Categories Table -->
    </div>
</div>
<!-- Sample Modal Content -->
<div id="exampleModalFullscreen" class="modal fade" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center w-100" id="exampleModalFullscreenLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class ="card"> 
                <div class="card-body p-4">
            <form id="productForm" action="{{ route('products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        
                        <div class="row justify-content-center">
                            <!-- Product Name -->
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="product_name" class="form-label">Product Name</label>
                                    <input class="form-control" type="text" name="product_name" id="product_name" placeholder="Enter product name" required>
                                </div>
                            </div>

                            <!-- Product Description -->
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="product_description" class="form-label">Product Description</label>
                                    <textarea class="form-control" name="product_description" id="product_description" rows="3" placeholder="Enter product description" required></textarea>
                                </div>
                            </div>

                            <!-- Product Image -->
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="product_image" class="form-label">Product Image</label>
                                    <input class="form-control" type="file" name="product_image" id="product_image" accept="image/*">
                                </div>
                                <div class="text-center">
                                    <img id="previewImage" src="{{ url('upload/no_image.jpg') }}" alt="Product Image Preview" class="rounded border p-2 bg-light" width="100">
                                </div>
                            </div>

                            <!-- Product Price -->
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="product_price" class="form-label">Price ($)</label>
                                    <input class="form-control" type="number" name="product_price" id="product_price" placeholder="Enter price" min="0.01" step="0.01" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
            </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection
