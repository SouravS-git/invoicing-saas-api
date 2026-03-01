<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <style>
        @page {
            size: 58mm auto;
            margin: 0;
        }

        body {
            width: 58mm;
            margin: 0;
            padding: 5px;
            font-family: monospace;
            font-size: 11px;
            color: #000;
            line-height: 1.35;
        }

        .center { text-align: center; }
        .right { text-align: right; }
        .bold { font-weight: bold; }

        .header-title {
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .meta {
            font-size: 10px;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 6px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 2px 0;
            vertical-align: top;
            word-break: break-word;
        }

        .label {
            width: 42%;
        }

        .value {
            width: 58%;
            text-align: right;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 2px;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.3px;
        }

        .status {
            display: inline-block;
            padding: 1px 4px;
            border: 1px solid #000;
            font-size: 9px;
        }

        .total-row td {
            padding-top: 4px;
            font-size: 12px;
            font-weight: bold;
        }

        .footer {
            margin-top: 6px;
            text-align: center;
            font-size: 10px;
        }

        .muted {
            font-size: 9px;
        }
    </style>
</head>
<body>

    <!-- BUSINESS HEADER -->
    <div class="center header-title">
        {{ $invoice->tenant->name }}
    </div>

    <div class="center meta">
        Invoice Receipt
    </div>

    <div class="line"></div>

    <!-- INVOICE META -->
    <table>
        <tr>
            <td class="label">Invoice #</td>
            <td class="value">{{ $invoice->invoice_number }}</td>
        </tr>

        <tr>
            <td class="label">Date</td>
            <td class="value">
                {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}
            </td>
        </tr>

        <tr>
            <td class="label">Status</td>
            <td class="value">
                <span class="status">{{ strtoupper($invoice->status) }}</span>
            </td>
        </tr>
    </table>

    <div class="line"></div>

    <!-- CUSTOMER -->
    <div class="section-title">Customer Details</div>

    <table>
        <tr>
            <td class="label">Name</td>
            <td class="value">{{ $invoice->customer_name }}</td>
        </tr>

        <tr>
            <td class="label">Email</td>
            <td class="value">{{ $invoice->customer_email }}</td>
        </tr>

        <tr>
            <td class="label">Phone</td>
            <td class="value">{{ $invoice->customer_phone }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <!-- BILLING ADDRESS -->
    <div class="section-title">Billing Address</div>

    <div>
        {{ $invoice->billing_address }}
    </div>

    <div class="line"></div>

    <!-- PAYMENT -->
    <div class="section-title">Payment Details</div>

    <table>
        <tr>
            <td class="label">Method</td>
            <td class="value">{{ ucfirst($invoice->payment_method) }}</td>
        </tr>

        <tr class="total-row">
            <td>Total</td>
            <td class="right">
                ₹ {{ number_format($invoice->total_amount, 2) }}
            </td>
        </tr>
    </table>

    <div class="line"></div>

    <!-- FOOTER -->
    <div class="footer">
        Thank you for your purchase! <br>
        <span class="muted">Please visit again</span>
    </div>

</body>
</html>
