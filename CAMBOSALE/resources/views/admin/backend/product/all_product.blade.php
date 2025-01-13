@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <!-- Start Page Title -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="text-dark font-weight-bold">Product Management</h4>
                    <a href="{{ route('add.product') }}" class="btn btn-primary btn-rounded">
                        <i class="fas fa-plus me-2"></i>Add Product
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Title -->
        <form method="GET" action="/filter">
            <div class="row pb-3"> 
                
                <div class="col-md-3 ">
                    <label> Start Date: </label>
                    <input type="date" class="form-control" name="start_date"> 
                </div>

                <div class="col-md-3 ">
                    <label> End Date: </label>
                    <input type="date" class="form-control" name="end_date"> 
                </div>

                <div class="col-md-1 pt-4"> 
                    <button type="submit" class="btn btn-primary"> Filter </button>
                </div>

                <div class="col-md-3 pt-4"> 
                    <a class="btn btn-dark" href="{{ route('export.category') }}"> Download Excel</a>
                </div>
            </div>
        </form>

        <!-- Categories Table -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 text-white">All Product</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-hover table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th> 
                                        <th>discription</th> 
                                        <th>qty</th> 
                                        <th>Price</th> 
                                        <th>Discount</th> 
                                        <th>Status</th> 
                                        <th>Date</th> 
                                        <th>Action</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <img src="{{ asset($item->image) }}" alt="" style="width: 70px; height: 40px;">
                                        </td>
                                        <td> {{ $item->name }} </td>
                                        <td> {{ $item->discription }} </td>
                                        <td> {{ $item->qty }} </td>
                                        <td> {{ $item->price }} </td>
                                        <td> {{ $item->discount_price }} </td> 
                                        <td> 
                                            @if($item->status == 1)
                                            <span class="text-success"><b> Active </b> </span>
                                            @else 
                                            <span class="text-danger"><b> InActive </b> </span> 
                                            @endif 
                                        </td> 
                                        
                                        <td>{{ $item->created_at->format('Y-m-d')}} </td>
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
