<?php

session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "HALISI_PHARMACY_MGT_SYS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$user_id = "";
$username = "";
$password = "";
$email = "";
$full_name = "";
$role = "";

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST["user_id"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $full_name = $_POST["full_name"];
    $role = $_POST["role"];

    if (empty($user_id) || empty($username) || empty($password) || empty($email) || empty($full_name) || empty($role) ) {
        $errorMessage = "All the fields are required!";
    } else {
        // Add new sale to database
        $sql = "INSERT INTO users (user_id, username, password, email, full_name, role) " .
            "VALUES ('$user_id', '$username', '$password', '$email', '$full_name', '$role')";

        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
        } else {
            // Store success message in session
            $_SESSION['successMessage'] = "User added successfully!";
            // Redirect after successful form submission
            header("location: /PHARMACY/users_management/users.php");
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php include 'header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/PHARMACY/users_management/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/PHARMACY/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <title>Users Management</title>
    <script src="/PHARMACY/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>New user</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
           <strong>$errorMessage</strong>
           <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
        }
        ?>

        <form method="POST">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">USER_ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="user_id" value="<?php echo $user_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">USER_NAME</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PASSWORD</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="password" value="<?php echo $password; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">EMAIL</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">FULL_NAME</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="full_name" value="<?php echo $full_name; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">ROLE</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="role" value="<?php echo $role; ?>">
            </div>
        </div>
        
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/PHARMACY/users_management/users.php" role="button">CANCEL</a>
                </div>
            </div>
        </form>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>