<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stylish Receipt</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e7e7e7;
            margin: 0;
            padding: 0;
        }
        .receipt-container {
            width: 80%;
            max-width: 600px;
            margin: 30px auto;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .receipt-items {
            padding: 20px;
            text-align:left;
        }
        .receipt-header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .receipt-header h1 {
            margin: 0;
        }
        .receipt-body {
            padding: 20px;
            line-height: 1.6;
        }
        .receipt-footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            font-size: 0.8em;
        }
        .receipt-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .receipt-item:last-child {
            margin-bottom: 0;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <h1>Payment Receipt</h1>
        </div>
        <div class="receipt-body">
            <!-- Your receipt content goes here -->
            <div class="receipt-details">
            <p style='color: brown;'>Dear customer, your purchase is as follows: </p>
            <p><strong>Merchant Request ID:</strong> <?php echo htmlspecialchars($_SESSION['MerchantRequestID']); ?></p>
            <p><strong>Checkout Request ID:</strong> <?php echo htmlspecialchars($_SESSION['CheckoutRequestID']); ?></p>
            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($_SESSION['phone_number']); ?></p>
        </div>
        </div>
        <div class="receipt-items">
    <h3>Items Purchased:</h3>
    <?php if (!empty($_SESSION['cart'])): ?>
        <table class="receipt-table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart_items'] as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td>KES <?php echo htmlspecialchars(number_format($item['price'], 2)); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No items in the cart.</p>
    <?php endif; ?>
</div>
        <div class="receipt-footer">
            Thank you for your purchase!
      */  </div>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()">Print this receipt</button>
        <button onclick="window.location.href='/your-next-page'">Continue</button>
    </div>
</body>
</html>
