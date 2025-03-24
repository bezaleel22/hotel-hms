<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { 
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        .header {
            margin-bottom: 30px;
        }
        .invoice-title {
            text-align: center;
            font-size: 24px;
            margin: 20px 0;
            color: #333;
        }
        .hotel-info {
            margin-bottom: 30px;
        }
        .customer-info {
            margin-bottom: 30px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .details-table th,
        .details-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .details-table th {
            background-color: #f5f5f5;
        }
        .totals {
            text-align: right;
            margin-top: 20px;
        }
        .totals div {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <?php if (!empty($hotel_logo)): ?>
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="<?php echo $hotel_logo; ?>" alt="<?php echo $hotel_name; ?>" style="max-height: 60px;">
        </div>
        <?php endif; ?>
        <h2><?php echo $hotel_name; ?></h2>
        <div>
            <?php echo $hotel_address; ?><br>
            Email: <?php echo $hotel_email; ?><br>
            Phone: <?php echo $hotel_phone; ?>
        </div>
    </div>

    <div class="invoice-title">
        <h1>INVOICE</h1>
        <div style="text-align: right;">
            Invoice #: <?php echo $invoice_number; ?><br>
            Date: <?php echo $invoice_date; ?>
        </div>
    </div>

    <div class="customer-info">
        <h3>Bill To:</h3>
        <div>
            <?php echo $customer_name; ?><br>
            <?php echo $customer_address; ?><br>
            Email: <?php echo $customer_email; ?><br>
            Phone: <?php echo $customer_phone; ?>
        </div>
    </div>

    <table class="details-table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $payment_details; ?></td>
                <td><?php echo $check_in; ?></td>
                <td><?php echo $check_out; ?></td>
                <td><?php echo $currency . ' ' . number_format($amount, 2); ?></td>
            </tr>
        </tbody>
    </table>

    <div class="totals">
        <div>Total Paid: <?php echo $currency . ' ' . number_format($amount, 2); ?></div>
        <div>Total Amount: <?php echo $currency . ' ' . number_format($total_price, 2); ?></div>
        <div>Balance: <?php echo $currency . ' ' . number_format($balance, 2); ?></div>
    </div>
</body>
</html>