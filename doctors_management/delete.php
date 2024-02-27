<?php
// Start the session
session_start();

if (isset($_GET["doctor_id"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "HALISI_PHARMACY_MGT_SYS";

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Get the value of the sale_id parameter
    $doctor_id_in = $_GET["doctor_id"];

    // Use prepared statements to delete the record safely
    $sql = "DELETE FROM doctors WHERE doctor_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $doctor_id_in);
    $stmt->execute();

    // Set the session variable with the success message
    $_SESSION['successMessage'] = "Doctor deleted successfully!";

    header("location: /PHARMACY/doctors_management/doctors.php");
    exit;
}