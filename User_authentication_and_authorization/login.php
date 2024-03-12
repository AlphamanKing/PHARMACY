<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database configuration
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "HALISI_PHARMACY_MGT_SYS";

// Create connection
$con = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$error = ''; // Variable to store error message

if (isset($_POST['username']) && isset($_POST['password'])) {
    // Sanitize input
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, sha1($_POST['password']));

    // SQL query to check the credentials
    $query = "SELECT * FROM users WHERE (username = '$username' OR email = '$username') AND password = '$password'";
    $result = mysqli_query($con, $query);

    // Check if the credentials are correct
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username; // Set the session with the username

        // Remember Me functionality
        if (!empty($_POST["remember"])) {
            setcookie("username", $_POST['username'], time() + (10 * 365 * 24 * 60 * 60)); // Set cookie for 10 years
            setcookie("password", $_POST['password'], time() + (10 * 365 * 24 * 60 * 60)); // Set cookie for 10 years
        } else {
            if (isset($_COOKIE["username"])) {
                setcookie("username", "");
            }
            if (isset($_COOKIE["password"])) {
                setcookie("password", "");
            }
        }

        header("location: ../Dashboards/Pharmacist_dashboard/"); // Redirect to the dashboard
        exit();
    } else {
        $error = 'Invalid Username or Password'; // Set error message
    }
}

$con->close();