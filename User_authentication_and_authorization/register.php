<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "HALISI_PHARMACY_MGT_SYS";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Initialize error variables
$fullNameErr = $userNameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Registration logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Sanitize user input
    $fullName = test_input($_POST['full-name']);
    $username = test_input($_POST['username']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $cpassword = test_input($_POST['confirm-password']);

    // Validate input
    if (empty($fullName)) {
        $fullNameErr = "Full name is required";
    }
    if (empty($username)) {
        $userNameErr = "Username is required";
    }
    if (empty($email)) {
        $emailErr = "Email is required";
    }
    if (empty($password)) {
        $passwordErr = "Password is required";
    }
    if (empty($cpassword)) {
        $confirmPasswordErr = "Confirming password is required";
    }

    // Check if all fields are filled
    if ($fullName && $username && $email && $password && $cpassword) {
        // Check if passwords match
        if ($password === $cpassword) {
            // Encrypt password
            $encrypt = sha1($password);

            // Prepare and bind
            $stmt = $con->prepare("INSERT INTO users (user_id,full_name, username, email, password, role) VALUES (?, ?, ?, ?, 'pharmacist')");
            $stmt->bind_param("ssss", $fullName, $username, $email, $encrypt);

            // Execute and check if successful
            if ($stmt->execute()) {
                echo "<script>alert('Dear $fullName, you have successfully registered. Please log in and access the Dashboard.')</script>";
                header("location: /PHARMACY/User_authentication_and_authorization/login.html");
            } else {
                echo "<script>alert('Error in registration.');</script>";
            }

            $stmt->close();
        } else {
            $confirmPasswordErr = "Passwords do not match.";
        }
    }
}

$con->close();
