<?php
session_start();

// Include the database config file
require_once 'db_config.php';

// Define variables
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT user_id, username, password FROM users WHERE username = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($user_id, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["user_id"] = $user_id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to the Dashboard
                            header("Location: /PHARMACY/Dashboards/Pharmacist_dashboard/index.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $conn->close();
}
?>

<!-- The rest of your HTML code for the login form goes here -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Login - Halisi Pharmacy Management System</title>
    <style>
        /* Add your custom styles here */
        body {
            background-image: url('login-image.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            color: #8a076b;
            
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        form {
            background-color: rgba(0,0,0, 0.5);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        input[type="text"],
        input[type="password"] {
            padding: 0.5rem;
            border-radius: 0.5rem;
            border: none;
            outline: none;
            width: 100%;
        }

        input[type="checkbox"] {
            margin-right: 0.5rem;
        }

        label {
            color: #fff;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        button[type="submit"]:hover {
            background-color: #3e8e41;
        }

        a {
            color: #fff;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
        }

        a:hover {
            color: #ccc;
        }

        .error {
            color: red;
            font-size: 0.8rem;
            margin-top: 0.5rem;
        }

        footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        footer a {
            margin-left: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Halisi Pharmacy Management System</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="username" id="username" placeholder="Username/Email" required>
            <div>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="fa fa-eye-slash" aria-hidden="true" onclick="togglePassword()"></i>
            </div>
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
            <a style="color: #e88260;" href="#">Forgot Password?</a>
            <button type="submit" name="submit">Login</button>
            <p style="color: #ef94f5;">Don't have an account? <a href="register.php">Register here</a></p>
            <!-- Remove PHP block -->
            <p class="error" id="error" style="color: red; display: none;"></p> <!-- Add an error paragraph -->
        </form>
    </div>
    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    
    <footer>
        <p>© 2023 Halisi Pharmacy Management System</p>
        <p>
            <a href="terms_of_service.php">Terms of Service</a>
            <a href="privacy_policy.php">Privacy Policy</a>
            <a href="contact_page.php">Contact Us</a>
        </p>
    </footer>

    <script src="js/login.js"></script>
</body>
</html>
