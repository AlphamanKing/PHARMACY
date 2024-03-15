<?php
session_start();
// Store current URL in session variable
$_SESSION['last_page'] = $_SERVER['REQUEST_URI'];
?>

<html>
<head>
    <style>
        /* Style the dashboard container */
        .dashboard {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin: 20px;
        }

        /* Style the dashboard cards */
        .card {
            width: 300px; /* Changed from 200px */
            height: 300px; /* Changed from 200px */
            margin: 5px; /* Changed from 10px */
            padding: 10px; /* Added this line */
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 10px;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        /* Style the card icons */
        .card-icon {
            width: 150px; /* Changed from 100px */
            height: 150px; /* Changed from 100px */
            margin-top: 20px;
        }

        /* Style the card titles */
        .card-title {
            font-size: 25px; /* Changed from 20px */
            font-weight: bold;
            margin-top: 10px;
        }

        /* Add hover effects to the cards */
        .card:hover {
            transform: scale(1.05);
            transition: 0.3s;
            cursor: pointer;
        }

        /* Style the header */
        .header {
            width: 100%;
            height: 80px;
            background-color: #697097;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
        }

        /* Style the header logo */
        .logo {
            width: 60px;
            height: 60px;
        }

        /* Style the header title */
        .title {
            font-size: 30px;
            font-weight: bold;
            color: #fffafa;
        }

        /* Style the header navigation */
        .nav {
            display: flex;
            list-style: none;
            color: #ffffff;
        }

        /* Style the header navigation links */
        .nav-link {
            margin: 10px;
            font-size: 20px;
            color: #fcf8f8;
            text-decoration: none;
        }

        /* Style the footer */
        .footer {
            width: 100%;
            height: 80px;
            background-color: #697097;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
        }

        /* Style the footer contact */
        .contact {
            display: flex;
            flex-direction: column;
            font-size: 15px;
            color: #fff;
        }

        /* Style the footer social media */
        .social {
            display: flex;
            list-style: none;
        }

        /* Style the footer social media icons */
        .social-icon {
            width: 30px;
            height: 30px;
            margin: 10px;
        }

        /* Style the footer legal */
        .legal {
            font-size: 15px;
            color: #fff;
        }
    </style>
    
    <title>
        Pharmacy Dashboard
    </title>
</head>
<body>
    <!-- Header section -->
    <div class="header">
        <!-- Header logo -->
        <img src="images/logo.png" alt="Logo" class="logo">
        <!-- Header title -->
        <p class="title">Pharmacy Dashboard</p>
        <!-- Header navigation -->
        <ul class="nav">
            <li><a href="/PHARMACY/index.php" class="nav-link">Home</a></li>
            <li><a href="../../User_authentication_and_authorization/terms_of_service.php" class="nav-link">Terms of Service</a></li>
            <li><a href="../../User_authentication_and_authorization/contact_page.php" class="nav-link">Contact</a></li>
        </ul>
    </div>
    <!-- Dashboard section -->
    <div class="dashboard">
        <!-- Customers management card -->
        <div class="card" onclick="window.location.href='../../customers_management/customers.php'">
            <img src="images/customers.png" alt="Customers" class="card-icon">
            <p class="card-title">Customers</p>
        </div>
        <!-- Doctors card -->
        <div class="card" onclick="window.location.href='../../doctors_management/doctors.php'">
            <img src="images/doctors.png" alt="Doctors" class="card-icon">
            <p class="card-title">Doctors</p>
        </div>
        <!-- Inventory card -->
        <div class="card" onclick="window.location.href='../../inventory_management/inventory.php'">
            <img src="images/inventory.png" alt="Inventory" class="card-icon">
            <p class="card-title">Inventory</p>
        </div>
        <!-- Sales card -->
        <div class="card" onclick="window.location.href='../../sales_management/sales.php'">
            <img src="images/sales.png" alt="Sales" class="card-icon">
            <p class="card-title">Sales</p>
        </div>
        <!-- Prescriptions card -->
        <div class="card" onclick="window.location.href='../../prescriptions_management/prescriptions.php'">
            <img src="images/prescriptions.png" alt="Prescriptions" class="card-icon">
            <p class="card-title">Prescriptions</p>
        </div>
        <!-- Reports card -->
        <div class="card" onclick="window.location.href='../../reports_management/reports.php'">
            <img src="images/reports.png" alt="Reports" class="card-icon">
            <p class="card-title">Reports</p>
        </div>
        <!-- Users card -->
        <div class="card" onclick="window.location.href='../../users_management/users.php'">
            <img src="images/users.png" alt="Users" class="card-icon">
            <p class="card-title">Users</p>
        </div>
        <!-- Pharmacy management card -->
        <div class="card" onclick="window.location.href='../../pharmacy_management/pharmacy.php'">
            <img src="images/pharmacy.png" alt="Pharmacy" class="card-icon">
            <p class="card-title">Pharmacy</p>
        </div>
    </div>
    <!-- Footer section -->
    <div class="footer">
        <!-- Footer contact -->
        <div class="contact">
            <p>Phone: +254 798946785</p>
            <p>Email: info@pharmacy.com</p>
            
        </div>
        <!-- Footer social media -->
        <ul class="social">
            <li><a href="https://www.facebook.com" target="_blank"><img src="images/facebook.png" alt="Facebook" class="social-icon"></a></li>
            <li><a href="https://www.twitter.com" target="_blank"><img src="images/twitter.png" alt="Twitter" class="social-icon"></a></li>
            <li><a href="https://www.instagram.com" target="_blank"><img src="images/instagram.jpeg" alt="Instagram" class="social-icon"></a></li>
        </ul>
        <!-- Footer legal -->
        <div class="legal">
        <p>© 2024 Halisi Pharmacy Management System.</p>
        <p>All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>


