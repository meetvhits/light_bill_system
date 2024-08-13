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
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="{{ route('customer') }}">Customer</a></li>
                        <li class="breadcrumb-item active">Add Customer</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-material" method="POST" action="{{ route('storecustomer') }}">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="FirstName">First Name</label>
                                        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" value="{{ old('first_name') }}" required>
                                        @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" value="{{ old('last_name') }}" required>
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
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="Phone">Phone</label>
                                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}" required>
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
                                            <option value="Male" @if (old('gender') == "Male") {{ 'selected' }} @endif>Male</option>
                                            <option value="Female" @if (old('gender') == "Female") {{ 'selected' }} @endif>Female</option>
                                            <option value="Other" @if (old('gender') == "Other") {{ 'selected' }} @endif>Other</option>
                                        </select>
                                        @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Address</label>
                                        <textarea class="form-control" id="address" name="address" placeholder="Address" rows="3" required>{{ old('address') }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <button name="submit" type="submit" class="btn btn-success text-white">
                                    <i class="fa fa-check"></i>
                                    Save
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

