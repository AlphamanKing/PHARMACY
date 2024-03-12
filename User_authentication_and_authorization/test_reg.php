<?php
require 'db_config.php';

$fullName = $_POST['full-name'] ?? null;
$username = $_POST['username'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$cpassword = $_POST['confirm-password'] ?? null;
$encrypt = $password ? sha1($password) : null;

if (isset($_POST['register'])) {
    if ($fullName && $username && $email && $password && $cpassword) {
        if ($password === $cpassword) {
            $query = mysqli_query($con, "INSERT INTO users (full_name, username, email, password, role)
            VALUES ('$fullName', '$username', '$email', '$encrypt', 'pharmacist')");
            
            if ($query) {
                echo "<script>alert('Dear $fullName, you have successfully registered. Please log in and access the Dashboard.')</script>";
                header("location:login.php");
            } else {
                echo "<script>alert('Error in registration.');</script>";
            }
        } else {
            echo "<script>alert('Passwords do not match.');</script>";
        }
    } else {
        echo "<script>alert('Please fill all the fields.');</script>";
    }
} else {
    echo "<script>alert('Registration button not set.');</script>";
}

