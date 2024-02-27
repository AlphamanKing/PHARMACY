<?php
// Start the session
session_start();

if (isset($_GET["customer_id"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "HALISI_PHARMACY_MGT_SYS";

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Get the value of the customer_id parameter
    $customer_id_in = $_GET["customer_id"];

    // Use prepared statements to delete the record safely
    $sql = "DELETE FROM customers WHERE customer_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customer_id_in);

    if ($stmt->execute()) {
       // Set the session variable with the success message
       $_SESSION['successMessage'] = "Customer deleted successfully!";
    } else {
       // Set the session variable with the error message
       $_SESSION['errorMessage'] = "Error deleting customer: " . $conn->error;
   }

   header("location: /PHARMACY/customers_management/customers.php");
   exit;

}
