<?php
   session_start();
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "HALISI_PHARMACY_MGT_SYS";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);

   $doctor_id="";
   $name="";
   $specialization="";

   $errorMessage = "";
   $successMessage="";

   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the sale
    if (!isset($_GET["doctor_id"])) {
        header("location: /PHARMACY/doctors_management/doctors.php");
        exit;
    }

    $doctor_id_in = $_GET["doctor_id"]; // Use a different variable name for the input

    // read the row of the selected sale from the database table
    $sql = "SELECT * FROM doctors WHERE doctor_id='$doctor_id_in'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /PHARMACY/doctors_management/doctors.php");
        exit;
    }

    $doctor_id_out = $row["doctor_id"]; // Use a different variable name for the output
    $name = $row["name"];
    $specialization = $row["specialization"];
    
   } else {
    // POST method: Update the data of the sale
    $doctor_id_in = $_POST["doctor_id"]; // Use the same variable name for the input
    $name = $_POST["name"];
    $specialization = $_POST["specialization"];

    do{
        if (empty($doctor_id_in) || empty($name) || empty($specialization) ) {
            $errorMessage = "All the fields are required!";
            break;
        }

        $sql = "UPDATE doctors " . 
        "SET doctor_id = '$doctor_id_in', name = '$name', specialization = '$specialization' " . 
        "WHERE doctor_id = $doctor_id_in"; // Use the same variable name for the input

        $result = $conn->query($sql);

        if (!$result) {
        $errorMessage = "Invalid query: " . $conn->error;
        break;
        }

        $successMessage = "Doctor updated successfully!";

        // Set the session variable with the success message
        $_SESSION['successMessage'] = $successMessage;

        header("location: /PHARMACY/doctors_management/doctors.php");
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
    <link rel="icon" href="/PHARMACY/doctors_management/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/PHARMACY/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <title>Doctors Management</title>
    <script src="/PHARMACY/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Edit Doctor</h2>

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
            <input type="hidden" name= "doctor_id" value="<?php echo $doctor_id_out; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">DOCTOR_ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="doctor_id" value="<?php echo htmlspecialchars($doctor_id_out); ?>">
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
            <label class="col-sm-3 col-form-label">SPECIALIZATION</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="specialization" value="<?php echo htmlspecialchars($specialization); ?>">
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-sm-6 offset-sm-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-secondary" href="/PHARMACY/doctors_management/doctors.php" role="button">Cancel</a>
            </div>
        </div>
        </form>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>
