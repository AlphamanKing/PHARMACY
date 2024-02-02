<?php
   session_start();
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "HALISI_PHARMACY_MGT_SYS";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);

   $user_id="";
   $username="";
   $password="";
   $email="";
   $full_name="";
   $role="";

   $errorMessage = "";
   $successMessage="";

   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the user
    if (!isset($_GET["user_id"])) {
        header("location: /PHARMACY/users_management/users.php");
        exit;
    }

    $user_id_in = $_GET["user_id"]; // Use a different variable name for the input

    // read the row of the selected user from the database table
    $sql = "SELECT * FROM users WHERE user_id='$user_id_in'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /PHARMACY/users_management/users.php");
        exit;
    }

    $user_id_out = $row["user_id"]; // Use a different variable name for the output
    $username = $row["username"];
    $password = $row["password"];
    $email = $row["email"];
    $full_name = $row["full_name"];
    $role = $row["role"];
    
   } else {
    // POST method: Update the data of the user
    $user_id_in = $_POST["user_id"]; // Use the same variable name for the input
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $full_name = $_POST["full_name"];
    $role = $_POST["role"];

    do{
        if (empty($user_id_in) || empty($username) || empty($password) || empty($email) || empty($full_name) || empty($role) ) {
            $errorMessage = "All the fields are required!";
            break;
        }

        $sql = "UPDATE users " . 
        "SET user_id = '$user_id_in', username = '$username', password = '$password', email = '$email', full_name = '$full_name', role = '$role' " . 
        "WHERE user_id = $user_id_in"; // Use the same variable name for the input

        $result = $conn->query($sql);

        if (!$result) {
        $errorMessage = "Invalid query: " . $conn->error;
        break;
        }

        $successMessage = "User updated successfully!";

        // Set the session variable with the success message
        $_SESSION['successMessage'] = $successMessage;

        header("location: /PHARMACY/users_management/users.php");
        exit;
    }while (false);
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
        <h2>Edit user</h2>

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
            <input type="hidden" name= "user_id" value="<?php echo $user_id_out; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">USER_ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="user_id" value="<?php echo htmlspecialchars($user_id_out); ?>">
                </div>
            </div>
            <!-- Rest of the form fields -->
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">USER_NAME</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($username); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PASSWORD</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="password" value="<?php echo htmlspecialchars($password); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">EMAIL</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">FULL_NAME</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="full_name" value="<?php echo htmlspecialchars($full_name); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">ROLE</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="role" value="<?php echo htmlspecialchars($role); ?>">
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-sm-6 offset-sm-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-secondary" href="/PHARMACY/users_management/users.php" role="button">Cancel</a>
            </div>
        </div>
        </form>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>
