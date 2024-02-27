<?php
// Start the session
session_start();

if (isset($_GET["report_id"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "HALISI_PHARMACY_MGT_SYS";

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Get the value of the report_id parameter
    $report_id_in = $_GET["report_id"];

    // Use prepared statements to delete the record safely
    $sql = "DELETE FROM reports WHERE report_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $report_id_in);
    $stmt->execute();

    // Set the session variable with the success message
    $_SESSION['successMessage'] = "Report deleted successfully!";

    header("location: /PHARMACY/reports_management/reports.php");
    exit;
}