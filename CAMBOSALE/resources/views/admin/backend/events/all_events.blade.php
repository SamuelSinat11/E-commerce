@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <!-- Start Page Title -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="text-dark font-weight-bold">Events Management</h4>
                    <a href="{{ route('add.events') }}" class="btn btn-primary btn-rounded">
                        <i class="fas fa-plus me-2"></i>Add Events
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <!-- Events Table -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 text-white">All Events</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-hover table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Description</th>
                                        <th>Pricing</th>
                                        <th>Seating Plan</th>
                                        <th>Banner Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->location }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>${{ number_format($item->pricing, 2) }}</td>
                                        <td>{{ $item->seating_plan }}</td>
                                        <td>
                                            @if($item->bannerImage)
                                                <img src="{{ asset($item->bannerImage) }}" alt="Banner" style="width: 70px; height:40px;">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('edit.events', $item->event_id) }}" class="btn btn-primary btn-sm me-2">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="{{ route('delete.events', $item->event_id) }}" id="delete" class="btn btn-danger btn-sm">
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
        <!-- End Events Table -->
    </div>
</div>

@endsection
