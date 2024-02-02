<?php
   session_start();
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "HALISI_PHARMACY_MGT_SYS";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);

   $report_id="";
   $prescription_id="";
   $report_date="";
   $report_type="";
   $report_content="";

   $errorMessage = "";
   $successMessage="";

   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the report
    if (!isset($_GET["report_id"])) {
        header("location: /PHARMACY/reports_management/reports.php");
        exit;
    }

    $report_id_in = $_GET["report_id"]; // Use a different variable name for the input

    // read the row of the selected report from the database table
    $sql = "SELECT * FROM reports WHERE report_id='$report_id_in'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /PHARMACY/reports_management/reports.php");
        exit;
    }

    $report_id_out = $row["report_id"]; // Use a different variable name for the output
    $prescription_id = $row["prescription_id"];
    $report_date = $row["report_date"];
    $report_type = $row["report_type"];
    $report_content = $row["report_content"];

   } else {
    // POST method: Update the data of the report
    $report_id_in = $_POST["report_id"]; // Use the same variable name for the input
    $prescription_id = $_POST["prescription_id"];
    $report_date = $_POST["report_date"];
    $report_type = $_POST["report_type"];
    $report_content = $_POST["report_content"];

    do{
        if (empty($report_id_in) || empty($prescription_id) || empty($report_date) || empty($report_type) || empty($report_content)) {
            $errorMessage = "All the fields are required!";
            break;
        }

        $sql = "UPDATE reports " . 
        "SET report_id = '$report_id_in', prescription_id = '$prescription_id', report_date = '$report_date', report_type = '$report_type', report_content = '$report_content' " . 
        "WHERE report_id = $report_id_in"; // Use the same variable name for the input

        $result = $conn->query($sql);

        if (!$result) {
        $errorMessage = "Invalid query: " . $conn->error;
        break;
        }

        $successMessage = "Report updated successfully!";

        // Set the session variable with the success message
        $_SESSION['successMessage'] = $successMessage;

        header("location: /PHARMACY/reports_management/reports.php");
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
    <link rel="icon" href="/PHARMACY/reports_management/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/PHARMACY/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <title>Reports Management</title>
    <script src="/PHARMACY/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Edit report</h2>

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
            <input type="hidden" name= "report_id" value="<?php echo $report_id_out; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">REPORT_ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="report_id" value="<?php echo htmlspecialchars($report_id_out); ?>">
                </div>
            </div>
            <!-- Rest of the form fields -->
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PRESCRIPTION_ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="prescription_id" value="<?php echo htmlspecialchars($prescription_id); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">REPORT_DATE</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="report_date" value="<?php echo htmlspecialchars($report_date); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">REPORT_TYPE</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="report_type" value="<?php echo htmlspecialchars($report_type); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">REPORT_CONTENT</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="report_content" value="<?php echo htmlspecialchars($report_content); ?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-6 offset-sm-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-secondary" href="/PHARMACY/reports_management/reports.php" role="button">Cancel</a>
            </div>
        </div>
        </form>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>
