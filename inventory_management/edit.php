<?php
   session_start();
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "HALISI_PHARMACY_MGT_SYS";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);

   $product_id="";
   $product_name="";
   $manufacturer="";
   $description="";
   $category="";
   $price="";
   $quantity="";
   $expiry_date="";

   $errorMessage = "";
   $successMessage="";

   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the product
    if (!isset($_GET["product_id"])) {
        header("location: /PHARMACY/inventory_management/inventory.php");
        exit;
    }

    $product_id_in = $_GET["product_id"]; // Use a different variable name for the input

    // read the row of the selected sale from the database table
    $sql = "SELECT * FROM inventory WHERE product_id='$product_id_in'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /PHARMACY/inventory_management/inventory.php");
        exit;
    }

    $product_id_out = $row["product_id"]; // Use a different variable name for the output
    $product_name = $row["product_name"];
    $manufacturer = $row["manufacturer"];
    $description = $row["description"];
    $category = $row["category"];
    $price = $row["price"];
    $quantity = $row["quantity"];
    $expiry_date = $row["expiry_date"];

   } else {
    // POST method: Update the data of the sale
    $product_id_in = $_POST["product_id"]; // Use the same variable name for the input
    $product_name = $_POST["product_name"];
    $manufacturer = $_POST["manufacturer"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $expiry_date = $_POST["expiry_date"];

    do{
        if (empty($product_id_in) || empty($product_name) || empty($manufacturer) || empty($description) || empty($category) || empty($price) || empty($quantity) || empty($expiry_date)) {
            $errorMessage = "All the fields are required!";
            break;
        }

        $sql = "UPDATE inventory " . 
        "SET product_id = '$product_id_in', product_name = '$product_name', manufacturer = '$manufacturer', description = '$description', category = '$category', price = '$price', quantity = '$quantity', expiry_date = '$expiry_date' " . 
        "WHERE product_id = $product_id_in"; // Use the same variable name for the input

        $result = $conn->query($sql);

        if (!$result) {
        $errorMessage = "Invalid query: " . $conn->error;
        break;
        }

        $successMessage = "Product updated successfully!";

        // Set the session variable with the success message
        $_SESSION['successMessage'] = $successMessage;

        header("location: /PHARMACY/inventory_management/inventory.php");
        exit;
    }while (false);
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
        <h2>Edit product</h2>

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
            <input type="hidden" name= "product_id" value="<?php echo $product_id_out; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">PRODUCT_ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="product_id" value="<?php echo htmlspecialchars($product_id_out); ?>">
                </div>
            </div>
            <!-- Rest of the form fields -->
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PRODUCT_NAME</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="product_name" value="<?php echo htmlspecialchars($product_name); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">MANUFACTURER</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="manufacturer" value="<?php echo htmlspecialchars($manufacturer); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">DESCRIPTION</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="description" value="<?php echo htmlspecialchars($description); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">CATEGORY</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="category" value="<?php echo htmlspecialchars($category); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PRICE</label>
            <div class="col-sm-6">
                <input type="currency" class="form-control" name="price" value="<?php echo htmlspecialchars($price); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">QUANTITY</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">EXPIRY_DATE</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="expiry_date" value="<?php echo htmlspecialchars($expiry_date); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-6 offset-sm-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-secondary" href="/PHARMACY/inventory_management/inventory.php" role="button">Cancel</a>
            </div>
        </div>
        </form>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>
