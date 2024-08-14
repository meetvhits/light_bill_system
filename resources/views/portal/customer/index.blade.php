@extends('layouts.master')
@section('content')

<!-- Page wrapper  -->
<div class="page-wrapper">
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Bread crumb and right sidebar toggle -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Customers</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <a type="button" href="{{ route('customer.create') }}" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('status') }}
                        </div>
                        @elseif(session('fail'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('fail') }}
                        </div>
                        @endif
                        <h4 class="card-title">Customers Record</h4>
                        {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                        <div class="table-responsive m-t-40">
                            <table id="myTable"
                                class="display nowrap table table-hover table-striped border"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customers Name</th>
                                        <th>Service No</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->id }}</td>
                                        <td>{{ strtoupper($customer->first_name.' '.$customer->last_name) }}</td>
                                        <td>{{ $customer->service_no }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->mobile }}</td>
                                        <td>{{ $customer->gender }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('customer.edit', [$customer->id]) }}" title="Edit Customer" type="button" class="btn btn-icon btn-outline-primary">
                                                <i class="feather icon-edit"></i> Edit
                                            </a>
                                            <a href="{{ route('deletecustomer', [$customer->id]) }}" title="Delete Customer" class="btn btn-icon btn-outline-primary" onclick="return confirm('Are you sure in delete Customer?')">
                                                <i class="feather icon-delete"></i> Delete
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
    </div>
</div>
@endsection
