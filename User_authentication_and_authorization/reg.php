<?php

include 'db_config.php';
// Define variables and initialize with empty values
$fullName = $username = $email = $password = $confirmPassword = "";
$fullNameErr = $userNameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate full name
    if (empty(trim($_POST["full-name"]))) {
        $fullNameErr = "Please enter your full name.";
    } else {
        $fullName = trim($_POST["full-name"]);
    }

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $userNameErr = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $emailErr = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $passwordErr = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $passwordErr = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm-password"]))) {
        $confirmPasswordErr = "Please confirm the password.";
    } else {
        $confirmPassword = trim($_POST["confirm-password"]);
        if (empty($passwordErr) && ($password != $confirmPassword)) {
            $confirmPasswordErr = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($fullNameErr) && empty($userNameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
        // Prepare an insert statement
        $sql = "INSERT INTO users (full_name, username, email, password, role) VALUES (?, ?, ?, ?, 'pharmacist')";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $param_fullName, $param_username, $param_email, $param_password);

            // Set parameters
            $param_fullName = $fullName;
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                header("location: login.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Halisi Pharmacy Management System</title>
    <link rel="stylesheet" href="register.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="registration-container">
        <img src="logo.png" alt="Halisi Pharmacy Logo">
        <h1>Register</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="full-name">Full Name:</label>
            <input type="text" id="full-name" name="full-name" required>
            <span class="error"><?php echo $fullNameErr; ?></span>
            <label for="username">User Name</label>
            <input type="text" id="username" name="username" required>
            <span class="error"><?php echo $userNameErr; ?></span>
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>
            <span class="error"><?php echo $emailErr; ?></span>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <span class="error"><?php echo $passwordErr; ?></span>
            <div class="password-strength" id="password-strength" style="color: rgb(88, 12, 158);">
                Password Strength: <span id="strength-label">Weak</span></div>
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
            <span class="error"><?php echo $confirmPasswordErr; ?></span>
            <label for="terms-and-conditions">
                <input type="checkbox" id="terms-and-conditions" name="terms-and-conditions" required>
                I accept the <a href="terms_of_service.html" target="_blank" style="color: brown;">Terms of Service</a> and <a href="privacy_policy.html" target="_blank" style="color: brown;">Privacy Policy</a>.
            </label>
            <button type="submit">Register</button>
        </form>
        <div class="error-message" id="error-message"></div>
        <p>Already have an account? <a href="login.php">Log in here</a></p>
    </div>
    <script src="register.js"></script>
</body>
</html>