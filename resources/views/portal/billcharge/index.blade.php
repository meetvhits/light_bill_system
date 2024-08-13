@extends('layouts.master')
@section('content')
<!-- Page wrapper  -->
<div class="page-wrapper">
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Bread crumb and right sidebar toggle -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Bill Charges</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <a type="button" href="{{ route('addbillcharge') }}" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</a>
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
                        <h4 class="card-title">Bill Charge</h4>
                        {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                        <div class="table-responsive m-t-40">
                            <table id="myTable"
                                class="display nowrap table table-hover table-striped border"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Government Duty (%)</th>
                                        <th>Fixed Charge (Rs)</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($billCharges as $billCharge)
                                    <tr>
                                        <td>{{ $billCharge->govt_duty_percentage }}</td>
                                        <td>{{ $billCharge->fixed_charge }}</td>
                                        <td>
                                            <a href="{{ route('editbillcharge', $billCharge->id) }}" class="btn btn-warning">Edit</a>
                                            <a href="{{ route('deletebillcharge', $billCharge->id) }}" title="Delete Unit Range" class="btn btn-icon btn-outline-primary" onclick="return confirm('Are you sure in delete Bill Charge?')">
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
