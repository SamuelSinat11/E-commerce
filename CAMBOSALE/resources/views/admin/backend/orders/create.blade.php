@extends('admin.admin_dashboard')
@section('admin')

<div class="bg-dark py-3"> 
    <h1 class="text-white"> Simple Laravel 11 CRUD </h1> 
</div>

<div class="container"> 
    <div class="row d-flex justify-content-center"> 
        <div class="col-md-10">
            <div class="card borde-0 shadow-lg">
                <h3> Create Orders </h3>
            </div>
            <div class="card-body">
                <div class="mb-3"> 
                    <label for="">Name </label>
                    <input type="text" class="form-control form-control-lg" placeholder="Name"
                    name = "name">
            </div>
        </div>
    </div>
</div>


@endsection
