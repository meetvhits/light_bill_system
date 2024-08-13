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
        {{-- <img src="{{ asset('images/company-logo.png') }}" alt="Company Logo"> --}}
        <h2>Light Bill</h2>
        <p><strong>{{ $lightBill->customer->first_name }} {{ $lightBill->customer->last_name }}</strong></p>
        <p>Service No: {{ $lightBill->customer->service_no }}</p>
        <p>Billing Date: {{ \Carbon\Carbon::parse($lightBill->reading_date)->format('F j, Y') }}</p>
    </div>

    <div class="bill-info">
        <p><strong>Supply Type:</strong> {{ $lightBill->supply_type }}</p>
        <p><strong>Reading Date:</strong> {{ \Carbon\Carbon::parse($lightBill->reading_date)->format('F j, Y') }}</p>
        <button style="float: right; margin-top: -30px;" id="myPrntbtn" onclick="printMyPage()">Print this page</button>
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
<script type="text/javascript">

    function printMyPage() {
        //Get the print button
        var printButton = document.getElementById("myPrntbtn");
        //Hide the print button
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Show back the print button on web page
        printButton.style.visibility = 'visible';
    }
</script>
</html>
