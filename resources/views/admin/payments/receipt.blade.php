<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Receipt #{{ $payment->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        .receipt {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .receipt-title {
            font-size: 20px;
            color: #666;
            margin-bottom: 20px;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .info-item {
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
            color: #666;
        }
        .amount {
            font-size: 18px;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        @media print {
            body {
                padding: 0;
            }
            .receipt {
                border: none;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <div class="company-name">{{ config('app.name') }}</div>
            <div class="receipt-title">Payment Receipt</div>
        </div>

        <div class="info-section">
            <div class="info-grid">
                <div>
                    <div class="info-item">
                        <div class="label">Receipt No:</div>
                        <div>#{{ $payment->id }}</div>
                    </div>
                    <div class="info-item">
                        <div class="label">Date:</div>
                        <div>{{ $payment->payment_date->format('d M, Y') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="label">Payment Method:</div>
                        <div>{{ ucfirst($payment->payment_method) }}</div>
                    </div>
                    @if($payment->payment_reference)
                    <div class="info-item">
                        <div class="label">Reference:</div>
                        <div>{{ $payment->payment_reference }}</div>
                    </div>
                    @endif
                </div>

                <div>
                    <div class="info-item">
                        <div class="label">Client Name:</div>
                        <div>{{ $payment->client->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="label">Phone:</div>
                        <div>{{ $payment->client->phone }}</div>
                    </div>
                    <div class="info-item">
                        <div class="label">Address:</div>
                        <div>{{ $payment->client->address }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="info-section">
            <div class="info-item">
                <div class="label">Invoice Number:</div>
                <div>#{{ $payment->invoice->id }}</div>
            </div>
            <div class="info-item">
                <div class="label">Amount Paid:</div>
                <div class="amount">৳{{ number_format($payment->amount, 2) }}</div>
            </div>
            @if($payment->notes)
            <div class="info-item">
                <div class="label">Notes:</div>
                <div>{{ $payment->notes }}</div>
            </div>
            @endif
        </div>

        <div class="footer">
            Thank you for your payment!<br>
            This is a computer generated receipt and does not require a signature.
        </div>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()">Print Receipt</button>
        <a href="{{ route('admin.payments.show', $payment) }}">
            <button>Back to Payment Details</button>
        </a>
    </div>
</body>
</html>