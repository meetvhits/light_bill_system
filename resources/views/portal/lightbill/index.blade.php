@extends('layouts.master')
@section('content')
<!-- Page wrapper  -->
<div class="page-wrapper">
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Bread crumb and right sidebar toggle -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Light Bill</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <a type="button" href="{{ route('addlightbill') }}" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</a>
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
                        <h4 class="card-title">Light Bill</h4>
                        {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                        <div class="table-responsive m-t-40">
                            <table id="myTable"
                                class="display nowrap table table-hover table-striped border"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Service No</th>
                                        <th>Supply Type</th>
                                        <th>Reading Date</th>
                                        <th>Present Reading</th>
                                        <th>Past Reading</th>
                                        <th>Past Amount</th>
                                        <th>Total Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lightBills as $lightBill)
                                    <tr>
                                        <td>{{ $lightBill->customer->first_name }} {{ $lightBill->customer->last_name }}</td>
                                        <td>{{ $lightBill->customer->service_no }}</td>
                                        <td>{{ $lightBill->supply_type }}</td>
                                        <td>{{ $lightBill->reading_date }}</td>
                                        <td>{{ $lightBill->present_reading }}</td>
                                        <td>{{ $lightBill->past_reading }}</td>
                                        <td>{{ $lightBill->past_amount }}</td>
                                        <td>{{ $lightBill->total_amount }}</td>
                                        <td>
                                            <a href="{{ route('showlightbill', $lightBill->id) }}" class="btn btn-info">View</a>
                                            <a href="{{ route('editlightbill', $lightBill->id) }}" class="btn btn-warning">Edit</a>
                                            <a href="{{ route('deletelightbill', $lightBill->id) }}" title="Delete Unit Range" class="btn btn-icon btn-outline-primary" onclick="return confirm('Are you sure in delete Light Bill?')">
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
