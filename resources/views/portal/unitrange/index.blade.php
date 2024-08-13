@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Unit Ranges</h4>
            </div>
        </div>
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('storeOrUpdate') }}" method="POST">
                        @csrf
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>Start Range</th>
                                    <th>End Range</th>
                                    <th>Price (Rs/unit)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="unit-ranges">
                                @foreach($unitRanges as $unit)
                                <tr>
                                    <td>
                                        <input type="hidden" name="units[{{ $loop->index }}][id]" value="{{ $unit->id }}">
                                        <input type="text" name="units[{{ $loop->index }}][start_range]" class="form-control" value="{{ $unit->start_range }}" required>
                                    </td>
                                    <td><input type="text" name="units[{{ $loop->index }}][end_range]" class="form-control" value="{{ $unit->end_range }}" required></td>
                                    <td><input type="number" step="0.01" name="units[{{ $loop->index }}][price]" class="form-control" value="{{ $unit->price }}" required></td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this, {{ $unit->id }})">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-success" onclick="addNewRow()">Add New Unit Range</button>
                        <button type="submit" class="btn btn-primary">Save All</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let rowIndex = {{ $unitRanges->count() }};

    function addNewRow() {
        let newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td><input type="number" name="units[${rowIndex}][start_range]" class="form-control" required></td>
            <td><input type="number" name="units[${rowIndex}][end_range]" class="form-control" required></td>
            <td><input type="number" step="0.01" name="units[${rowIndex}][price]" class="form-control" required></td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">Delete</button>
            </td>
        `;

        document.querySelector('#unit-ranges').appendChild(newRow);
        rowIndex++;
    }

    function deleteRow(button, id = null) {
        if (id) {
            if (confirm('Are you sure you want to delete this unit range?')) {
                fetch(`/deleteunitrange/${id}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(() => {
                    button.closest('tr').remove();
                });
            }
        } else {
            button.closest('tr').remove();
        }
    }
</script>
@endsection
