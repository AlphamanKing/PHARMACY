<?php

session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "HALISI_PHARMACY_MGT_SYS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$product_id = "";
$product_name = "";
$manufacturer = "";
$description = "";
$category = "";
$price = "";
$quantity = "";
$expiry_date = "";

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $manufacturer = $_POST["manufacturer"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $expiry_date = $_POST["expiry_date"];

    if (empty($product_id) || empty($product_name) || empty($manufacturer) || empty($description) || empty($category) || empty($price) || empty($quantity) || empty($expiry_date)) {
        $errorMessage = "All the fields are required!";
    } else {
        // Add new sale to database
        $sql = "INSERT INTO inventory (product_id, product_name, manufacturer, description, category, price, quantity, expiry_date) " .
            "VALUES ('$product_id', '$product_name', '$manufacturer', '$description', '$category', '$price', '$quantity', '$expiry_date')";

        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
        } else {
            // Store success message in session
            $_SESSION['successMessage'] = "Product added successfully!";
            // Redirect after successful form submission
            header("location: /PHARMACY/inventory_management/inventory.php");
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
    <link rel="icon" href="/PHARMACY/inventory_management/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/PHARMACY/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <title>Inventory Management</title>
    <script src="/PHARMACY/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>New Product</h2>

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
                <label class="col-sm-3 col-form-label">PRODUCT_ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="product_id" value="<?php echo $product_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PRODUCT_NAME</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="product_name" value="<?php echo $product_name; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">MANUFACTURER</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="manufacturer" value="<?php echo $manufacturer; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">DESCRIPTION</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">CATEGORY</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="category" value="<?php echo $category; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PRICE</label>
            <div class="col-sm-6">
                <input type="currency" class="form-control" name="price" value="<?php echo $price; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">QUANTITY</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="quantity" value="<?php echo $quantity; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">EXPIRY_DATE</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="expiry_date" value="<?php echo $expiry_date; ?>">
            </div>
        </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/PHARMACY/inventory_management/inventory.php" role="button">CANCEL</a>
                </div>
            </div>
        </form>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>