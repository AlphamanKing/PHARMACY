<?php

session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "HALISI_PHARMACY_MGT_SYS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sale_id = "";
$product_id = "";
$pharmacy_id = "";
$customer_id = "";
$sale_date = "";
$quantity = "";
$total_amount = "";

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sale_id = $_POST["sale_id"];
    $product_id = $_POST["product_id"];
    $pharmacy_id = $_POST["pharmacy_id"];
    $customer_id = $_POST["customer_id"];
    $sale_date = $_POST["sale_date"];
    $quantity = $_POST["quantity"];
    $total_amount = $_POST["total_amount"];

    if (empty($sale_id) || empty($product_id) || empty($pharmacy_id) || empty($customer_id) || empty($sale_date) || empty($quantity) || empty($total_amount)) {
        $errorMessage = "All the fields are required!";
    } else {
        // Add new sale to database
        $sql = "INSERT INTO sales (sale_id, product_id, pharmacy_id, customer_id, sale_date, quantity, total_amount) " .
            "VALUES ('$sale_id', '$product_id', '$pharmacy_id', '$customer_id', '$sale_date', '$quantity', '$total_amount')";

        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
        } else {
            // Store success message in session
            $_SESSION['successMessage'] = "Sale added successfully!";
            // Redirect after successful form submission
            header("location: /PHARMACY/sales_management/sales.php");
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php include 'header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/PHARMACY/sales_management/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/PHARMACY/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <title>Sales Management</title>
    <script src="/PHARMACY/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>New Client</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
           <strong>$errorMessage</strong>
           <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
        }
        ?>

        <form method="POST">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">SALE_ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="sale_id" value="<?php echo $sale_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PRODUCT_ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="product_id" value="<?php echo $product_id; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PHARMACY_ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="pharmacy_id" value="<?php echo $pharmacy_id; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">CUSTOMER_ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="customer_id" value="<?php echo $customer_id; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">SALE_DATE</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="sale_date" value="<?php echo $sale_date; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">QUANTITY</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="quantity" value="<?php echo $quantity; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">TOTAL_AMOUNT</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="total_amount" value="<?php echo $total_amount; ?>">
            </div>
        </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/PHARMACY/sales_management/sales.php" role="button">CANCEL</a>
                </div>
            </div>
        </form>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>