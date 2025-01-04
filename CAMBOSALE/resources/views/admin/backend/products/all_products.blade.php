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



<!-- sample modal content -->
<div id="exampleModalFullscreen" class="modal fade" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalFullscreenLabel">Fullscreen Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Overflowing text to show scroll behavior</h5>
                <p>Cras mattis consectetur purus sit amet fermentum.
                    Cras justo odio, dapibus ac facilisis in,
                    egestas eget quam. Morbi leo risus, porta ac
                    consectetur ac, vestibulum at eros.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection
