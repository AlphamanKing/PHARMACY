<?php
   session_start();
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "HALISI_PHARMACY_MGT_SYS";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);

   $pharmacy_id="";
   $pharmacy_name="";
   $location="";
   $phone="";
   $email="";

   $errorMessage = "";
   $successMessage="";

   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the sale
    if (!isset($_GET["pharmacy_id"])) {
        header("location: /PHARMACY/pharmacy_management/pharmacy.php");
        exit;
    }

    $pharmacy_id_in = $_GET["pharmacy_id"]; // Use a different variable name for the input

    // read the row of the selected sale from the database table
    $sql = "SELECT * FROM pharmacy WHERE pharmacy_id='$pharmacy_id_in'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /PHARMACY/pharmacy_management/pharmacy.php");
        exit;
    }

    $pharmacy_id_out = $row["pharmacy_id"]; // Use a different variable name for the output
    $pharmacy_name = $row["pharmacy_name"];
    $location = $row["location"];
    $phone = $row["phone"];
    $email = $row["email"];
    
   } else {
    // POST method: Update the data of the sale
    $pharmacy_id_in = $_POST["pharmacy_id"]; // Use the same variable name for the input
    $pharmacy_name = $_POST["pharmacy_name"];
    $location = $_POST["location"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    do{
        if (empty($pharmacy_id_in) || empty($pharmacy_name) || empty($location) || empty($phone) || empty($email) ) {
            $errorMessage = "All the fields are required!";
            break;
        }

        $sql = "UPDATE pharmacy " . 
        "SET pharmacy_id = '$pharmacy_id_in', pharmacy_name = '$pharmacy_name', location = '$location', phone = '$phone', email = '$email' " . 
        "WHERE pharmacy_id = $pharmacy_id_in"; // Use the same variable name for the input

        $result = $conn->query($sql);

        if (!$result) {
        $errorMessage = "Invalid query: " . $conn->error;
        break;
        }

        $successMessage = "Pharmacy updated successfully!";

        // Set the session variable with the success message
        $_SESSION['successMessage'] = $successMessage;

        header("location: /PHARMACY/pharmacy_management/pharmacy.php");
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
    <link rel="icon" href="/PHARMACY/pharmacy_management/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/PHARMACY/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <title>Pharmacy Management</title>
    <script src="/PHARMACY/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Edit pharmacy</h2>

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
            <input type="hidden" name= "pharmacy_id" value="<?php echo $pharmacy_id_out; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">PHARMACY_ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="pharmacy_id" value="<?php echo htmlspecialchars($pharmacy_id_out); ?>">
                </div>
            </div>
            <!-- Rest of the form fields -->
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PHARMACY_NAME</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="pharmacy_name" value="<?php echo htmlspecialchars($pharmacy_name); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">LOCATION</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="location" value="<?php echo htmlspecialchars($location); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PHONE</label>
            <div class="col-sm-6">
                <input type="phone" class="form-control" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">EMAIL</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>">
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-sm-6 offset-sm-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-secondary" href="/PHARMACY/pharmacy_management/pharmacy.php" role="button">Cancel</a>
            </div>
        </div>
        </form>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>
