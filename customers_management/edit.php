<?php
   session_start();
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "HALISI_PHARMACY_MGT_SYS";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);

   $customer_id="";
   $name="";
   $email="";
   $phone="";
   $address="";

   $errorMessage = "";
   $successMessage="";

   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the customer
    if (!isset($_GET["customer_id"])) {
        header("location: /PHARMACY/customers_management/customers.php");
        exit;
    }

    $customer_id_in = $_GET["customer_id"]; // Use a different variable name for the input

    // read the row of the selected sale from the database table
    $sql = "SELECT * FROM customers WHERE customer_id='$customer_id_in'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /PHARMACY/customers_management/customers.php");
        exit;
    }

    $customer_id_out = $row["customer_id"]; // Use a different variable name for the output
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
    
   } else {
    // POST method: Update the data of the customer
    $customer_id_in = $_POST["customer_id"]; // Use the same variable name for the input
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do{
        if (empty($customer_id_in) || empty($name) || empty($email) || empty($phone) || empty($address) ) {
            $errorMessage = "All the fields are required!";
            break;
        }

        $sql = "UPDATE customers " . 
        "SET customer_id = '$customer_id_in', name = '$name', email = '$email', phone = '$phone', address = '$address' " . 
        "WHERE customer_id = $customer_id_in"; // Use the same variable name for the input

        $result = $conn->query($sql);

        if (!$result) {
        $errorMessage = "Invalid query: " . $conn->error;
        break;
        }

        $successMessage = "Customer updated successfully!";

        // Set the session variable with the success message
        $_SESSION['successMessage'] = $successMessage;

        header("location: /PHARMACY/customers_management/customers.php");
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
    <link rel="icon" href="/PHARMACY/sales_management/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/PHARMACY/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <title>Customers Management</title>
    <script src="/PHARMACY/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Edit customer</h2>

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
            <input type="hidden" name= "customer_id" value="<?php echo $customer_id_out; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">CUSTOMER_ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="customer_id" value="<?php echo htmlspecialchars($customer_id_out); ?>">
                </div>
            </div>
            <!-- Rest of the form fields -->
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">NAME</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">EMAIL</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PHONE</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">ADDRESS</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($address); ?>">
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-sm-6 offset-sm-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-secondary" href="/PHARMACY/customers_management/customers.php" role="button">Cancel</a>
            </div>
        </div>
        </form>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>
