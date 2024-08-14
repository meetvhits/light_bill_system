@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Bill Charge</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        {{-- <li class="breadcrumb-item"><a href="{{ route('billcharge') }}">Bill Charge</a></li> --}}
                        <li class="breadcrumb-item active">Edit Bill Charge</li>
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
                        <h2>Edit Unit Range</h2>
                        <form action="{{ route('billcharge.update', $billCharge->id) }}" method="POST">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="govt_duty_percentage">Government Duty (%)</label>
                                <input type="number" name="govt_duty_percentage" id="govt_duty_percentage" class="form-control" value="{{ $billCharge->govt_duty_percentage }}"  required>
                            </div>
                            <div class="form-group">
                                <label for="fixed_charge">Fixed Charge (Rs)</label>
                                <input type="number" name="fixed_charge" id="fixed_charge" class="form-control" value="{{ $billCharge->fixed_charge }}"  required>
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                            {{-- <a class="btn btn-primary text-wite" href="{{ route('billcharge') }}">Back</a> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
