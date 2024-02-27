<?php
// Start the session
session_start();

if (isset($_GET["sale_id"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "HALISI_PHARMACY_MGT_SYS";

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Get the value of the sale_id parameter
    $sale_id_in = $_GET["sale_id"];

    // Use prepared statements to delete the record safely
    $sql = "DELETE FROM sales WHERE sale_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $sale_id_in);
    $stmt->execute();

    // Set the session variable with the success message
    $_SESSION['successMessage'] = "Sale deleted successfully!";

    header("location: /PHARMACY/sales_management/sales.php");
    exit;
}

