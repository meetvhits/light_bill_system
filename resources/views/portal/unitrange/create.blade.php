@extends('layouts.master')
@section('content')
<!-- Page wrapper  -->
<div class="page-wrapper">
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Bread crumb and right sidebar toggle -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Unit Range</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="{{ route('unitrange.index') }}">Unit Range</a></li>
                        <li class="breadcrumb-item active">Add Unit Range</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('storeunitrange') }}" method="POST">
                            @csrf
                            {{-- <div id="unit-ranges"> --}}
                                <div id="range-container">
                                    <div class="form-group">
                                        <div class="row range-row">
                                            {{-- <div class="row"> --}}
                                            <div class="col-md-3">
                                                <label for="start">Start Range</label>
                                                <input type="number" name="unit_ranges[0][start_range]" id="start_range" class="form-control" required>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="end">End Range</label>
                                                <input type="number" name="unit_ranges[0][end_range]" id="end_range" class="form-control" required>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="price">Price</label>
                                                <input type="number" name="unit_ranges[0][price]" id="price" class="form-control"  required>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" id="add-range" class="btn btn-secondary" style="margin-top: 23px;">Add Range</button>
                                            </div>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                </div>
                            {{-- </div> --}}
                            <button type="submit" class="btn btn-success">Create</button>
                            <a class="btn btn-primary text-wite" href="{{ route('billcharge') }}">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // document.getElementById('add-range').addEventListener('click', function() {
    //     const unitRanges = document.getElementById('unit-ranges');
    //     const rangeCount = unitRanges.children.length / 3;

    //     const startDiv = document.createElement('div');
    //     startDiv.className = 'form-group';
    //     const startLabel = document.createElement('label');
    //     startLabel.setAttribute('for', `start-${rangeCount}`);
    //     startLabel.innerText = 'Start';
    //     const startInput = document.createElement('input');
    //     startInput.type = 'number';
    //     startInput.name = `unit_ranges[${rangeCount}][start]`;
    //     startInput.id = `start-${rangeCount}`;
    //     startInput.className = 'form-control';
    //     startInput.required = true;
    //     startDiv.appendChild(startLabel);
    //     startDiv.appendChild(startInput);

    //     const endDiv = document.createElement('div');
    //     endDiv.className = 'form-group';
    //     const endLabel = document.createElement('label');
    //     endLabel.setAttribute('for', `end-${rangeCount}`);
    //     endLabel.innerText = 'End';
    //     const endInput = document.createElement('input');
    //     endInput.type = 'number';
    //     endInput.name = `unit_ranges[${rangeCount}][end]`;
    //     endInput.id = `end-${rangeCount}`;
    //     endInput.className = 'form-control';
    //     endInput.required = true;
    //     endDiv.appendChild(endLabel);
    //     endDiv.appendChild(endInput);

    //     const priceDiv = document.createElement('div');
    //     priceDiv.className = 'form-group';
    //     const priceLabel = document.createElement('label');
    //     priceLabel.setAttribute('for', `price-${rangeCount}`);
    //     priceLabel.innerText = 'Price';
    //     const priceInput = document.createElement('input');
    //     priceInput.type = 'number';
    //     priceInput.name = `unit_ranges[${rangeCount}][price]`;
    //     priceInput.id = `price-${rangeCount}`;
    //     priceInput.className = 'form-control';
    //     priceInput.step = '0.01';
    //     priceInput.required = true;
    //     priceDiv.appendChild(priceLabel);
    //     priceDiv.appendChild(priceInput);

    //     unitRanges.appendChild(startDiv);
    //     unitRanges.appendChild(endDiv);
    //     unitRanges.appendChild(priceDiv);
    // });

    let rangeIndex = 1; // To keep track of the number of rows added

document.getElementById('add-range').addEventListener('click', function () {
    const rangeContainer = document.getElementById('range-container');

    // Create a new row
    const newRow = document.createElement('div');
    newRow.classList.add('row', 'range-row');
    newRow.innerHTML = `
        <div class="col-md-3">
            <label for="start">Start Range</label>
            <input type="number" name="unit_ranges[${rangeIndex}][start_range]" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label for="end">End Range</label>
            <input type="number" name="unit_ranges[${rangeIndex}][end_range]" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label for="price">Price</label>
            <input type="number" name="unit_ranges[${rangeIndex}][price]" class="form-control" required>
        </div>

        <div class="col-md-3">
            <button type="button" class="btn btn-danger remove-range" style="margin-top: 23px;">-</button>
        </div>
    `;

    rangeContainer.appendChild(newRow);
    rangeIndex++;

    // Add event listener for the remove button
    newRow.querySelector('.remove-range').addEventListener('click', function () {
        newRow.remove();
    });
});
</script>
@endsection
