@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Light Bill</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="{{ route('billcharge') }}">Light Bill</a></li>
                        <li class="breadcrumb-item active">Edit Light Bill</li>
                    </ol>
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
                        <h2>Edit Light Bill</h2>
                        <form action="{{ route('updatelightbill', $lightBill->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="customer_id">Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control">
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ $customer->id == $lightBill->customer_id ? 'selected' : '' }}>{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="supply_type">Supply Type</label>
                                <input type="text" name="supply_type" id="supply_type" class="form-control" value="{{ $lightBill->supply_type }}" required>
                            </div>
                            <div class="form-group">
                                <label for="reading_date">Reading Date</label>
                                <input type="date" name="reading_date" id="reading_date" class="form-control" value="{{ $lightBill->reading_date }}" required>
                            </div>
                            <div class="form-group">
                                <label for="present_reading">Present Reading</label>
                                <input type="number" name="present_reading" id="present_reading" class="form-control" value="{{ $lightBill->present_reading }}" required>
                            </div>
                            <div class="form-group">
                                <label for="past_reading">Past Reading</label>
                                <input type="number" name="past_reading" id="past_reading" class="form-control" value="{{ $lightBill->past_reading }}" required>
                            </div>
                            <div class="form-group">
                                <label for="past_amount">Past Amount</label>
                                <input type="number" name="past_amount" id="past_amount" class="form-control" value="{{ $lightBill->past_amount }}" step="0.01" required>
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                            <a class="btn btn-primary text-wite" href="{{ route('lightbill') }}">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
