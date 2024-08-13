@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Customers</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="{{ route('customer') }}">Customer</a></li>
                        <li class="breadcrumb-item active">Edit Customer</li>
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
                        <h4 class="card-title">Edit Customer</h4>
                        {{-- <h6 class="card-subtitle">Just add <code>form-material</code> class to the form that's it.</h6> --}}
                        <form class="form-material m-t-40" method="POST" action="{{ route('updatecustomer',[$customer->id]) }}">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="FirstName">First Name</label>
                                        <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', $customer->first_name) }}"  placeholder="First Name" required>
                                        @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" id="last_name" name="last_name" class="form-control" value="{{ $customer->last_name }}" placeholder="Last Name" required>
                                        @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="Email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{ $customer->email }}" placeholder="Email" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="Phone">Phone</label>
                                        <input type="text" id="phone" name="phone" value="{{ $customer->phone }}" class="form-control" placeholder="Enter Mobile" required>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label">Gender</label>
                                        <select class="form-select" name="gender">
                                            <option value="" disabled selected>Select your gender</option>
                                            <option value="Male" {{ old('gender', $customer->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender', $customer->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Other" {{ old('gender', $customer->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Address</label>
                                        <textarea class="form-control" id="address" name="address" placeholder="Address" rows="3" required>{{ $customer->address }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success text-white">
                                    <i class="fa fa-check"></i>
                                    Update
                                </button>
                                <a class="btn btn-primary text-wite" href="{{ route('customer') }}">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
