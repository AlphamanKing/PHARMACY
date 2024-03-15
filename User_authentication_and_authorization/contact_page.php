<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database credentials
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "HALISI_PHARMACY_MGT_SYS";

// Create connection
$link = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

// Define variables and initialize with empty values
$name = $email = $message = "";
$name_err = $email_err = $message_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name.";
    } else{
        $name = trim($_POST["name"]);
    }
    
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email address.";
    } else{
        $email = trim($_POST["email"]);
    }

    // Validate message
    if(empty(trim($_POST["message"]))){
        $message_err = "Please enter your message.";
    } else{
        $message = trim($_POST["message"]);
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($message_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_message);
            
            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_message = $message;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
              // Echo out the success message in bold and with a larger font size
              echo '<div style="font-weight: bold; font-size: 40px; color: green; margin-top: 50px; text-align: center;">Message received! Thank you very much for contacting us.</div>';
    
            // Redirect to the referring page after a short delay
            echo '<script type="text/javascript">
               setTimeout(function() {
                   window.location.href = "' . $_SESSION['last_page'] . '";
                }, 2600);
                </script>';
            exit;
        } else{
         echo "Oops! Something went wrong. Please try again later.";
    }


            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact Us - Halisi Pharmacy</title>
<style>
    /* Reset some default styles */
    body, h2, form, input, textarea, button {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
    }

    /* Apply a natural box layout model */
    *, *:before, *:after {
        box-sizing: border-box;
    }

    /* Page styling */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        color: #333;
        line-height: 1;
        padding: 50px;
    }

    /* Form wrapper styling */
    .wrapper {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Form title */
    h2 {
        font-size: 24px;
        color: #5D6975;
        margin-bottom: 10px;
        text-align: center;
    }

    /* Form description */
    p {
        margin-bottom: 20px;
        text-align: center;
    }

    /* Form field styling */
    .form-control {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    /* Error message styling */
    .error {
        color: #e74c3c;
        font-size: 14px;
        margin-bottom: 15px;
        display: block;
    }

    /* Submit button styling */
    .btn-primary {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        background-color: #3498db;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }

    /* Responsive adjustments */
    @media (max-width: 600px) {
        .wrapper {
            width: auto;
            padding: 15px;
        }
    }
</style>
</head>
<body>
    <div class="wrapper">
        <h2>Contact Us</h2>
        <p>Please fill in this form and send us a message.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="error"><?php echo $name_err; ?></span>
            </div>    
            <div>
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="error"><?php echo $email_err; ?></span>
            </div>
            <div>
                <label>Message</label>
                <textarea name="message" class="form-control"><?php echo $message; ?></textarea>
                <span class="error"><?php echo $message_err; ?></span>
            </div>
            <div>
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>    
</body>
</html>
