<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "HALISI_PHARMACY_MGT_SYS";

// Include the login script
include '/PHARMACY/User_authentication_and_authorization/login.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assume user_id is available in session or cookie
session_start(); // Make sure to start the session
$user_id = $_SESSION['user_id'] ?? null;
$isAdmin = null; // Set to null to determine the role later

// Check if the user is in the users table
if ($user_id) {
    $stmt = $conn->prepare("SELECT role FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $isAdmin = $row['role'] !== 'pharmacist'; 
        //var_dump($isAdmin);
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        header {
            background-color: #343a40; 
            padding: 10px 0; 
            text-align: center; 
        }

        .navbar-brand {
            color: #fff;
            font-weight: bold;
            display: block;
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<body>
<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Halisi Pharmacy Management System</a>
    <?php if (isset($showBackButton) && $showBackButton === true): ?>
      <a class="btn btn-outline-light btn-sm" href="/PHARMACY/index.php" style="margin-right: 30px;">
        <i class="bi bi-house-door"></i> BACK TO MAIN PAGE
      </a>
      <?php if ($isAdmin === true): ?>
        <a href="/PHARMACY/master-module/admin/index.php" class="btn btn-secondary">Admin Dashboard</a>
      <?php elseif ($isAdmin === false): ?>
        <a href="/PHARMACY/Dashboards/Pharmacist_dashboard/index.php" class="btn btn-primary">Pharmacist Dashboard</a>
      <?php endif; ?>
   <?php endif; ?>
  </div>
</nav>

</header>