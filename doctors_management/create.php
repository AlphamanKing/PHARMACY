<?php

session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "HALISI_PHARMACY_MGT_SYS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$doctor_id = "";
$name = "";
$specialization = "";

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $doctor_id = $_POST["doctor_id"];
    $name = $_POST["name"];
    $specialization = $_POST["specialization"];

    if (empty($doctor_id) || empty($name) || empty($specialization) ) {
        $errorMessage = "All the fields are required!";
    } else {
        // Add new sale to database
        $sql = "INSERT INTO doctors (doctor_id, name, specialization) " .
            "VALUES ('$doctor_id', '$name', '$specialization')";

        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
        } else {
            // Store success message in session
            $_SESSION['successMessage'] = "Doctor added successfully!";
            // Redirect after successful form submission
            header("location: /PHARMACY/doctors_management/doctors.php");
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
    <link rel="icon" href="/PHARMACY/doctors_management/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/PHARMACY/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <title>Doctors Management</title>
    <script src="/PHARMACY/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>New Doctor</h2>

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
                <label class="col-sm-3 col-form-label">DOCTOR_ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="doctor_id" value="<?php echo $doctor_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">NAME</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">SPECIALIZATION</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="specialization" value="<?php echo $specialization; ?>">
            </div>
        </div>
        
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/PHARMACY/doctors_management/doctors.php" role="button">CANCEL</a>
                </div>
            </div>
        </form>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>