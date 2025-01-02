@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <!-- Start Page Title -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="text-dark font-weight-bold">Category Management</h4>
                    <a href="{{ route('add.category') }}" class="btn btn-primary btn-rounded">
                        <i class="fas fa-plus me-2"></i>Add Category
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <!-- Categories Table -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 text-white">All Categories</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-hover table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->category_name }}</td>
                                        <td><img src="{{ asset($item->image) }}" alt="" style="width: 70px; height:40px;"></td>
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

@endsection
