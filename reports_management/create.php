<?php

session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "HALISI_PHARMACY_MGT_SYS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$report_id = "";
$prescription_id = "";
$report_date = "";
$report_type = "";
$report_content = "";

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $report_id = $_POST["report_id"];
    $prescription_id = $_POST["prescription_id"];
    $report_date = $_POST["report_date"];
    $report_type = $_POST["report_type"];
    $report_content = $_POST["report_content"];

    if (empty($report_id) || empty($prescription_id) || empty($report_date) || empty($report_type) || empty($report_content) ) {
        $errorMessage = "All the fields are required!";
    } else {
        // Add new report to database
        $sql = "INSERT INTO reports (report_id, prescription_id, report_date, report_type, report_content) " .
            "VALUES ('$report_id', '$prescription_id', '$report_date', '$report_type', '$report_content')";

        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
        } else {
            // Store success message in session
            $_SESSION['successMessage'] = "Report added successfully!";
            // Redirect after successful form submission
            header("location: /PHARMACY/reports_management/reports.php");
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
    <link rel="icon" href="/PHARMACY/reports_management/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/PHARMACY/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <title>Reports Management</title>
    <script src="/PHARMACY/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>New Report</h2>

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
                <label class="col-sm-3 col-form-label">REPORT_ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="report_id" value="<?php echo $report_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PRESCRIPTION_ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="prescription_id" value="<?php echo $prescription_id; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">REPORT_DATE</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="report_date" value="<?php echo $report_date; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">REPORT_TYPE</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="report_type" value="<?php echo $report_type; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">REPORT_CONTENT</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="report_content" value="<?php echo $report_content; ?>">
            </div>
        </div>
       
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/PHARMACY/reports_management/reports.php" role="button">CANCEL</a>
                </div>
            </div>
        </form>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>