{{-- @extends('layouts.master')
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
                        <li class="breadcrumb-item active">Show Light Bill</li>
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
                        <h4 class="card-title">Show Light Bill</h4>
                        <div class="table-responsive m-t-40">
                            <table
                                class="display nowrap table table-hover table-striped border"
                                cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <th>Customer</th>
                                        <td>{{ $lightBill->customer->first_name }} {{ $lightBill->customer->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Service No</th>
                                        <td>{{ $lightBill->customer->service_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Supply Type</th>
                                        <td>{{ $lightBill->supply_type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Reading Date</th>
                                        <td>{{ $lightBill->reading_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Present Reading</th>
                                        <td>{{ $lightBill->present_reading }}</td>
                                    </tr>
                                    <tr>
                                        <th>Past Reading</th>
                                        <td>{{ $lightBill->past_reading }}</td>
                                    </tr>
                                    <tr>
                                        <th>Past Amount</th>
                                        <td>{{ $lightBill->past_amount }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Amount</th>
                                        <td>{{ $lightBill->total_amount }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


<!DOCTYPE html>
<html>
<head>
    <title>Light Bill</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            max-width: 100px;
        }
        .header h2 {
            margin: 10px 0 0 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            font-size: 14px;
        }
        .bill-info {
            margin-bottom: 20px;
        }
        .bill-info p {
            margin: 5px 0;
            font-size: 16px;
        }
        .bill-info strong {
            font-weight: bold;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table, .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #f2f2f2;
            text-align: center;
            font-size: 16px;
        }
        .table td {
            text-align: center;
            font-size: 14px;
        }
        .table-footer {
            margin-top: 30px;
        }
        .table-footer p {
            font-size: 14px;
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <img src="{{ asset('images/company-logo.png') }}" alt="Company Logo">
        <h2>Light Bill</h2>
        <p><strong>{{ $lightBill->customer->first_name }} {{ $lightBill->customer->last_name }}</strong></p>
        <p>Service No: {{ $lightBill->customer->service_no }}</p>
        <p>Billing Date: {{ \Carbon\Carbon::parse($lightBill->reading_date)->format('F j, Y') }}</p>
    </div>

    <div class="bill-info">
        <p><strong>Supply Type:</strong> {{ $lightBill->supply_type }}</p>
        <p><strong>Reading Date:</strong> {{ \Carbon\Carbon::parse($lightBill->reading_date)->format('F j, Y') }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Past Reading</th>

                <td>{{ $lightBill->past_reading }}</td>
            </tr>
            <tr>
                <th>Present Reading</th>
                <td>{{ $lightBill->present_reading }}</td>
            </tr>
            <tr>
                <th>Units Consumed</th>
                <td>{{ $lightBill->total_units }}</td>
            </tr>
            <tr>
                <th>Unit Rate (Rs/unit)</th>
                <td>{{ $lightBill->base_rate }}</td>
            </tr>
            <tr>
                <th>Government Duty</th>
                <td>{{ $lightBill->govt_duty }} %</td>
            </tr>
            <tr>
                <th>Total Unit Rate (Rs/unit)</th>
                <td>{{ $lightBill->total_units * $lightBill->base_rate }}</td>
            </tr>
            <tr>
                <th>Past Amount (Rs)</th>
                <td>{{ number_format($lightBill->past_amount, 2) }}</td>
            </tr>
            <tr>
                <th>Government Duty Charges</th>
                <td>{{ $lightBill->govt_duty_charge }}</td>
            </tr>
            <tr>
                <th>Fixed Charges</th>
                <td>{{ $lightBill->fixed_charge }}</td>
            </tr>
            <tr>
                <th>Total Amount (Rs)</th>
                <td><strong>{{ number_format($lightBill->total_amount, 2) }}</strong></td>
            </tr>
        </thead>
        <tbody>

            </tr>
        </tbody>
    </table>

    {{-- <div class="table-footer">
        <p><strong></strong> {{ $lightBill->govt_duty }} %</p>
        <p><strong>:</strong> {{ $lightBill-> }} Rs</p>

        <p><strong>:</strong> {{ $lightBill-> }}</p>
    </div> --}}

    <div class="footer">
        <p>Thank you for your prompt payment!</p>
        <p>If you have any questions about this bill, please contact our customer service at (123) 456-7890.</p>
    </div>
</div>

</body>
</html>
