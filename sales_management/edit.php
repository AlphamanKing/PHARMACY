<?php
   session_start();
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "HALISI_PHARMACY_MGT_SYS";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);

   $sale_id="";
   $product_id="";
   $pharmacy_id="";
   $customer_id="";
   $sale_date="";
   $quantity="";
   $total_amount="";

   $errorMessage = "";
   $successMessage="";

   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the sale
    if (!isset($_GET["sale_id"])) {
        header("location: /PHARMACY/sales_management/sales.php");
        exit;
    }

    $sale_id_in = $_GET["sale_id"]; // Use a different variable name for the input

    // read the row of the selected sale from the database table
    $sql = "SELECT * FROM sales WHERE sale_id='$sale_id_in'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /PHARMACY/sales_management/sales.php");
        exit;
    }

    $sale_id_out = $row["sale_id"]; // Use a different variable name for the output
    $product_id = $row["product_id"];
    $pharmacy_id = $row["pharmacy_id"];
    $customer_id = $row["customer_id"];
    $sale_date = date('Y-m-d', strtotime($row["sale_date"])); // Convert the date to the format "yyyy-mm-dd"
    $quantity = $row["quantity"];
    $total_amount = $row["total_amount"];
   } else {
    // POST method: Update the data of the sale
    $sale_id_in = $_POST["sale_id"]; // Use the same variable name for the input
    $product_id = $_POST["product_id"];
    $pharmacy_id = $_POST["pharmacy_id"];
    $customer_id = $_POST["customer_id"];
    $sale_date = $_POST["sale_date"];
    $quantity = $_POST["quantity"];
    $total_amount = $_POST["total_amount"];

    do{
        if (empty($sale_id_in) || empty($product_id) || empty($pharmacy_id) || empty($customer_id) || empty($sale_date) || empty($quantity) || empty($total_amount)) {
            $errorMessage = "All the fields are required!";
            break;
        }

        $sql = "UPDATE sales " . 
        "SET sale_id = '$sale_id_in', product_id = '$product_id', pharmacy_id = '$pharmacy_id', customer_id = '$customer_id', sale_date = '$sale_date', quantity = '$quantity', total_amount = '$total_amount' " . 
        "WHERE sale_id = $sale_id_in"; // Use the same variable name for the input

        $result = $conn->query($sql);

        if (!$result) {
        $errorMessage = "Invalid query: " . $conn->error;
        break;
        }

        $successMessage = "Sale updated successfully!";

        // Set the session variable with the success message
        $_SESSION['successMessage'] = $successMessage;

        header("location: /PHARMACY/sales_management/sales.php");
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
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/PHARMACY/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <title>Sales Management</title>
    <script src="/PHARMACY/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Edit sale</h2>

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
            <input type="hidden" name= "sale_id" value="<?php echo $sale_id_out; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">SALE_ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="sale_id" value="<?php echo htmlspecialchars($sale_id_out); ?>">
                </div>
            </div>
            <!-- Rest of the form fields -->
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PRODUCT_ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PHARMACY_ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="pharmacy_id" value="<?php echo htmlspecialchars($pharmacy_id); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">CUSTOMER_ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="customer_id" value="<?php echo htmlspecialchars($customer_id); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">SALE_DATE</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="sale_date" value="<?php echo htmlspecialchars($sale_date); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">QUANTITY</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">TOTAL_AMOUNT</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="total_amount" value="<?php echo htmlspecialchars($total_amount); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-6 offset-sm-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-secondary" href="/PHARMACY/sales_management/sales.php" role="button">Cancel</a>
            </div>
        </div>
        </form>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>
