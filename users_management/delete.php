<?php
// Start the session
session_start();

if (isset($_GET["user_id"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "HALISI_PHARMACY_MGT_SYS";

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Get the value of the user_id parameter
    $user_id_in = $_GET["user_id"];

    // Use prepared statements to delete the record safely
    $sql = "DELETE FROM users WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id_in);
    $stmt->execute();

    // Set the session variable with the success message
    $_SESSION['successMessage'] = "User deleted successfully!";

    header("location: /PHARMACY/users_management/users.php");
    exit;
}