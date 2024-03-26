<?php
session_start();
// Store current URL in session variable
$_SESSION['last_page'] = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/PHARMACY/images/favicon.ico" type="image/x-icon">
    <title>Welcome to Halisi Pharmacy</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="welcome-background">
        <!-- Background image set in CSS -->
       <div class="welcome-message-container">
        <div class="welcome-message">
            <h1>Welcome to Halisi Pharmacy Management System</h1> <br><br>
            
        </div>
       </div>
    </div>

    <div class="card-container">
        <div class="card" onclick="location.href='User_authentication_and_authorization/login.php';">
            <img src="images/pharmacist.jpeg" alt="Pharmacist">
            <h3>Pharmacist</h3>
            <p>Manage prescriptions and inventory. </p>
            
        </div>
        <div class="card" onclick="location.href='master-module/index.php';">
            <img src="images/customers.png" alt="Customer">
            <h3>Customer</h3>
            <p>Shop for medicines and wellness products.</p>
            
        </div>
        <div class="card" onclick="location.href='master-module/admin/index.php';">
            <img src="images/admin.jpg" alt="Admin">
            <h3>Admin</h3>
            <p>Oversee and manage pharmacy operations</p>
            
        </div>
    </div>
    <footer>
        <p>© 2023 Halisi Pharmacy Management System</p>
        <p>
            <a href="User_authentication_and_authorization/terms_of_service.php">Terms of Service</a>
            <a href="User_authentication_and_authorization/privacy_policy.php">Privacy Policy</a>
            <a href="User_authentication_and_authorization/contact_page.php">Contact Us</a>
        </p>
    </footer>
</body>
</html>

