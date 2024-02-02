<?php
   session_start();
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "HALISI_PHARMACY_MGT_SYS";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);

   $prescription_id="";
   $customer_id="";
   $doctor_id="";
   $prescription_date="";
   $status="";
   $notes="";

   $errorMessage = "";
   $successMessage="";

   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the prescription
    if (!isset($_GET["prescription_id"])) {
        header("location: /PHARMACY/prescriptions_management/prescriptions.php");
        exit;
    }

    $prescription_id_in = $_GET["prescription_id"]; // Use a different variable name for the input

    // read the row of the selected prescription from the database table
    $sql = "SELECT * FROM prescriptions WHERE prescription_id='$prescription_id_in'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /PHARMACY/prescriptions_management/prescriptions.php");
        exit;
    }

    $prescription_id_out = $row["prescription_id"]; // Use a different variable name for the output
    $customer_id = $row["customer_id"];
    $doctor_id = $row["doctor_id"];
    $prescription_date = $row["prescription_date"];
    $status = $row["status"]; // Convert the date to the format "yyyy-mm-dd"
    $notes = $row["notes"];

   } else {
    // POST method: Update the data of the prescription
    $prescription_id_in = $_POST["prescription_id"]; // Use the same variable name for the input
    $customer_id = $_POST["customer_id"];
    $doctor_id = $_POST["doctor_id"];
    $prescription_date = $_POST["prescription_date"];
    $status = $_POST["status"];
    $notes = $_POST["notes"];

    do{
        if (empty($prescription_id_in) || empty($customer_id) || empty($doctor_id) || empty($prescription_date) || empty($status) || empty($notes)) {
            $errorMessage = "All the fields are required!";
            break;
        }

        $sql = "UPDATE prescriptions " . 
        "SET prescription_id = '$prescription_id_in', customer_id = '$customer_id', doctor_id = '$doctor_id', prescription_date = '$prescription_date', status = '$status', notes = '$notes' " . 
        "WHERE prescription_id = $prescription_id_in"; // Use the same variable name for the input

        $result = $conn->query($sql);

        if (!$result) {
        $errorMessage = "Invalid query: " . $conn->error;
        break;
        }

        $successMessage = "Prescription updated successfully!";

        // Set the session variable with the success message
        $_SESSION['successMessage'] = $successMessage;

        header("location: /PHARMACY/prescriptions_management/prescriptions.php");
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
    <link rel="icon" href="/PHARMACY/prescriptions_management/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/PHARMACY/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <title>Prescriptions Management</title>
    <script src="/PHARMACY/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Edit prescription</h2>

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
            <input type="hidden" name= "prescription_id" value="<?php echo $prescription_id_out; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">PRESCRIPTION_ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prescription_id" value="<?php echo htmlspecialchars($prescription_id_out); ?>">
                </div>
            </div>
            <!-- Rest of the form fields -->
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">CUSTOMER_ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="customer_id" value="<?php echo htmlspecialchars($customer_id); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">DOCTOR_ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="doctor_id" value="<?php echo htmlspecialchars($doctor_id); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PRESCRIPTION_DATE</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="prescription_date" value="<?php echo htmlspecialchars($prescription_date); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">STATUS</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="status" value="<?php echo htmlspecialchars($status); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">NOTES</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="notes" value="<?php echo htmlspecialchars($notes); ?>">
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-sm-6 offset-sm-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-secondary" href="/PHARMACY/prescriptions_management/prescriptions.php" role="button">Cancel</a>
            </div>
        </div>
        </form>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>
