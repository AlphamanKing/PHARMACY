<?php

session_start(); // Start the session

// Check if success message exists in session
if (isset($_SESSION['successMessage'])) {
    $successMessage = $_SESSION['successMessage'];
    // Clear the success message from session to avoid displaying it again on page refresh
    unset($_SESSION['successMessage']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    $showBackButton = true;
    include 'header.php'; 
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/PHARMACY/doctors_management/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/PHARMACY/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <title>Doctors Management</title>
</head>

<body>
    <div class="container my-5">
        <?php
        if (!empty($successMessage)) {
            echo "
        <div id='successMessage' class='alert alert-success alert-dismissible fade show' role='alert'>
           <strong>$successMessage</strong>
           <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
        }
        ?>
        <h2>Doctors Management</h2>
        <a class="btn btn-primary" href="/PHARMACY/doctors_management/create.php" role="button">New Record</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>DOCTOR_ID</th>
                    <th>NAME</th>
                    <th>SPECIALIZATION</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "HALISI_PHARMACY_MGT_SYS";


                // create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("connection failed: " . $conn->connect_error);
                }

                //read all rows from database table
                $sql = "SELECT * FROM doctors";
                $result = $conn->query($sql);

                if (! $result) {
                    die("Invalid query: " . $conn->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[doctor_id]</td>
                    <td>$row[name]</td>
                    <td>$row[specialization]</td>
                    <td>
                    <a class='btn btn-primary btn-sm' href='/PHARMACY/doctors_management/edit.php?doctor_id=$row[doctor_id]'>Edit</a>

                    <a class='btn btn-danger btn-sm' href='/PHARMACY/doctors_management/delete.php?doctor_id=$row[doctor_id]'>Delete</a>
                    </td>
                </tr>
                    ";
                }
                ?>
                
            </tbody>
        </table>
    </div>

    <script>
        // Automatically hide success message after 4 seconds
        setTimeout(function() {
            document.getElementById('successMessage').style.display = 'none';
        }, 2800);
    </script>
</body>
<?php include 'footer.php'; ?>
</html>
