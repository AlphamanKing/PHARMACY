<?php
// Start the session
session_start();

if (isset($_GET["pharmacy_id"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "HALISI_PHARMACY_MGT_SYS";

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Get the value of the sale_id parameter
    $pharmacy_id_in = $_GET["pharmacy_id"];

    // Use prepared statements to delete the record safely
    $sql = "DELETE FROM pharmacy WHERE pharmacy_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pharmacy_id_in);
    $stmt->execute();

    // Set the session variable with the success message
    $_SESSION['successMessage'] = "Pharmacy deleted successfully!";

    header("location: /PHARMACY/pharmacy_management/pharmacy.php");
    exit;
}