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
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="{{ route('lightbill.index') }}">Light Bill</a></li>
                        <li class="breadcrumb-item active">Add Light Bill</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('lightbill.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="customer_id">Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control">
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="supply_type">Supply Type</label>
                                <input type="text" name="supply_type" id="supply_type" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="reading_date">Reading Date</label>
                                <input type="date" name="reading_date" id="reading_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="present_reading">Present Reading</label>
                                <input type="number" name="present_reading" id="present_reading" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="past_reading">Past Reading</label>
                                <input type="number" name="past_reading" id="past_reading" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="past_amount">Past Amount</label>
                                <input type="number" name="past_amount" id="past_amount" class="form-control"  required>
                            </div>
                            <button type="submit" class="btn btn-success">Create</button>
                            <a class="btn btn-primary text-wite" href="{{ route('lightbill.index') }}">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
