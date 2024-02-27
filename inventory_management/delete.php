<?php
// Start the session
session_start();

if (isset($_GET["product_id"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "HALISI_PHARMACY_MGT_SYS";

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Get the value of the sale_id parameter
    $product_id_in = $_GET["product_id"];

    // Use prepared statements to delete the record safely
    $sql = "DELETE FROM inventory WHERE product_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id_in);
    $stmt->execute();

    // Set the session variable with the success message
    $_SESSION['successMessage'] = "Product deleted successfully!";

    header("location: /PHARMACY/inventory_management/inventory.php");
    exit;
}