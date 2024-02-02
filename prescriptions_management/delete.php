<?php
// Start the session
session_start();

if (isset($_GET["prescription_id"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "HALISI_PHARMACY_MGT_SYS";

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Get the value of the prescription_id parameter
    $prescription_id_in = $_GET["prescription_id"];

    // Use prepared statements to delete the record safely
    $sql = "DELETE FROM prescriptions WHERE prescription_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $prescription_id_in);
    $stmt->execute();

    // Set the session variable with the success message
    $_SESSION['successMessage'] = "Prescription deleted successfully!";

    header("location: /PHARMACY/prescriptions_management/prescriptions.php");
    exit;
}