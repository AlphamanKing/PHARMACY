<?php

session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "HALISI_PHARMACY_MGT_SYS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$prescription_id = "";
$customer_id = "";
$doctor_id = "";
$prescription_date = "";
$status = "";
$notes = "";

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prescription_id = $_POST["prescription_id"];
    $customer_id = $_POST["customer_id"];
    $doctor_id = $_POST["doctor_id"];
    $prescription_date = $_POST["prescription_date"];
    $status = $_POST["status"];
    $notes = $_POST["notes"];

    if (empty($prescription_id) || empty($customer_id) || empty($doctor_id) || empty($prescription_date) || empty($status) || empty($notes)) {
        $errorMessage = "All the fields are required!";
    } else {
        // Add new sale to database
        $sql = "INSERT INTO prescriptions (prescription_id, customer_id, doctor_id, prescription_date, status, notes) " .
            "VALUES ('$prescription_id', '$customer_id', '$doctor_id', '$prescription_date', '$status', '$notes')";

        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
        } else {
            // Store success message in session
            $_SESSION['successMessage'] = "Prescription added successfully!";
            // Redirect after successful form submission
            header("location: /PHARMACY/prescriptions_management/prescriptions.php");
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
    <link rel="icon" href="/PHARMACY/prescriptions_management/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/PHARMACY/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <title>Prescriptions Management</title>
    <script src="/PHARMACY/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>New prescription</h2>

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
                <label class="col-sm-3 col-form-label">PRESCRIPTION_ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prescription_id" value="<?php echo $prescription_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">CUSTOMER_ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="customer_id" value="<?php echo $customer_id; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">DOCTOR_ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="doctor_id" value="<?php echo $doctor_id; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PRESCRIPTION_DATE</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="prescription_date" value="<?php echo $prescription_date; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">STATUS</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="status" value="<?php echo $status; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">NOTES</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="notes" value="<?php echo $notes; ?>">
            </div>
        </div>
       
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/PHARMACY/prescriptions_management/prescriptions.php" role="button">CANCEL</a>
                </div>
            </div>
        </form>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>