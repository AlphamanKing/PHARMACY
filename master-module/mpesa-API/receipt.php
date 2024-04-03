<?php 
session_start();
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

//include '../cart.php';
include '../includes/functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt</title>
    <style>
       body {
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    text-align: center;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.centered-message {
    text-align: center;
    margin-top: 20px; 
}

.message {
    font-size: 1.5em;
    color: #007BFF; /* Changed to a blue color */
    display: inline-block; 
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.receipt-container {
    max-width: 1000px; /* Increased width */
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.receipt-header {
    background-color: #e9ecef; /* Changed to a light gray color */
    color: #343a40; /* Darker text for contrast */
    padding: 20px;
    text-align: center;
}

.receipt-header h1 {
    margin: 0;
}

.receipt-details {
    padding: 20px;
    background-color: #f7f7f7;
    border-bottom: 2px solid #eee;
}

.receipt-details p {
    margin: 0;
    padding: 5px 0;
    text-align: left;
}

.receipt-items {
    padding: 20px;
    text-align: left;
}
 
.receipt-table {
    width: 100%; /* Make table use full width of the container */
    border-collapse: collapse;
}

.receipt-table th, 
.receipt-table td {
    padding: 8px; /* Added padding to table cells */
    text-align: left;
    border-bottom: 1px solid #eee;
}

.receipt-total {
    text-align: right;
    padding: 20px;
    font-size: 20px;
    font-weight: bold;
    background-color: #f7f7f7;
    border-top: 2px solid #eee;
}

.button-container {
    text-align: center;
    margin-top: 20px;
}

button {
    background-color: #007BFF; /* Changed to a blue color */
    color: white;
    padding: 10px 20px;
    margin: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #0056b3; /* Slightly darker on hover */
}

@media print {
    .no-print {
        display: none;
    }
}

    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <h1>Payment Receipt</h1>
        </div>
        <div class="receipt-details">
            <p style='color: brown;'>Dear customer, your purchase is as follows: </p>
            <p><strong>Merchant Request ID:</strong> <?php echo htmlspecialchars($_SESSION['MerchantRequestID']); ?></p>
            <p><strong>Checkout Request ID:</strong> <?php echo htmlspecialchars($_SESSION['CheckoutRequestID']); ?></p>
            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($_SESSION['phone_number']); ?></p>
        </div>
        <div class="receipt-items">
    <h3>Items Purchased:</h3>
    <?php if (!empty($_SESSION['cart'])): ?>
        <table class="receipt-table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Brand</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $data = get_cart(); // Fetch the cart items
                foreach ($_SESSION['cart'] as $index => $item): 
                    // Check if there's corresponding, valid data from 'get_cart()`
                    if (isset($data[$index]) && !empty($data[$index][0])): 
                ?>
                        <tr>
                            <td><?php echo htmlspecialchars($data[$index][0]['item_title']); ?></td>
                            <td>KES <?php echo htmlspecialchars($data[$index][0]['item_price']); ?></td>
                            <td><?php echo htmlspecialchars($data[$index][0]['item_brand']); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        </tr>
                    <?php 
                    endif;  // End if 
                endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No items in the cart.</p>
    <?php endif; ?>


</div>

        <div class="receipt-total">
            Total: KES <?php echo htmlspecialchars($_SESSION['total_amount']); ?>
        </div>
    </div>
    <div class="button-container no-print">
        <button onclick="window.print()">Print this receipt</button>
        <button onclick="window.location.href='/PHARMACY/master-module/final.php?order=done'">Complete Order</button>
    </div>
    <div class="centered-message">
        <p class="message">After we confirm the payment from our side, we will ship your order in 1-2 days. Welcome, once again!</p>
    </div>
</body>

</html>

