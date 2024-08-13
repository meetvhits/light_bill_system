@extends('layouts.master')
@section('content')
<!-- Page wrapper  -->
<div class="page-wrapper">
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Bread crumb and right sidebar toggle -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Bill Charge</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="{{ route('billcharge') }}">Bill Charge</a></li>
                        <li class="breadcrumb-item active">Add Bill Charge</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('storebillcharge') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="govt_duty_percentage">Government Duty (%)</label>
                                <input type="number" name="govt_duty_percentage" id="govt_duty_percentage" class="form-control"  required>
                            </div>
                            <div class="form-group">
                                <label for="fixed_charge">Fixed Charge (Rs)</label>
                                <input type="number" name="fixed_charge" id="fixed_charge" class="form-control"  required>
                            </div>
                            <button type="submit" class="btn btn-success">Create</button>
                            <a class="btn btn-primary text-wite" href="{{ route('billcharge') }}">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
