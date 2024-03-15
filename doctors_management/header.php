<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        header {
            background-color: #343a40; 
            padding: 10px 0; 
            text-align: center; 
        }

        .navbar-brand {
            color: #fff;
            font-weight: bold;
            display: block;
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Halisi Pharmacy Management System</a>
                <?php
                // Check if the $showBackButton variable is set and true
                if (isset($showBackButton) && $showBackButton === true) {
                    echo '<a class="btn btn-outline-light btn-sm" href="/PHARMACY/index.php"><i class="bi bi-house-door"></i> BACK TO MAIN PAGE</a>
                    ';
                }
                ?>
                <!-- Add any additional header content or navigation links here -->
            </div>
        </nav>
    </header>