@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Unit Range</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="{{ route('unitrange') }}">Unit Range</a></li>
                        <li class="breadcrumb-item active">Edit Unit Range</li>
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
                        <form action="{{ route('updateunitrange', $unitRange->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="start">Start Range</label>
                                <input type="number" name="start_range" id="start_range" class="form-control" value="{{ $unitRange->start_range }}" required>
                            </div>
                            <div class="form-group">
                                <label for="end">End Range</label>
                                <input type="number" name="end_range" id="end_range" class="form-control" value="{{ $unitRange->end_range }}" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" class="form-control" value="{{ $unitRange->price }}"  required>
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                            <a class="btn btn-primary text-wite" href="{{ route('billcharge') }}">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
