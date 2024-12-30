@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">All Category</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <td>
                                <a href="{{ route('add.category')}}" class="btn btn-primary waves-effect waves-light">  Add Category</a>
                            </td>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      <h3> ទិន្នន័យទាំងអស់បានបង្ហាញដូចខាងក្រោម​ </h3> 
                    </div>
                    <div class="card-body">

                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                            <tr>
                                <th>ID</th>
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
                                    <td>
                                        <img src="{{ asset($item->image) }}" alt="Category Image" style="width: 70px; height: 70px;">
                                    </td>

                                   <td class="text-center">
                                        <a href="" class="btn btn-info btn-sm waves-effect waves-light mx-2">EDIT</a>
                                        <a href="" class="btn btn-danger btn-sm waves-effect waves-light mx-2">DELETE</a>
                                </td>    
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row --> 

    </div> <!-- container-fluid -->
</div>


@endsection
