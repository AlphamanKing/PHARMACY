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
    <?php if (isset($showBackButton) && $showBackButton === true): ?>
      <a class="btn btn-outline-light btn-sm" href="/PHARMACY/index.php" style="margin-right: 30px;">
        <i class="bi bi-house-door"></i> BACK TO MAIN PAGE
      </a>
      
        <a href="/PHARMACY/master-module/admin/index.php" class="btn btn-secondary" style="margin-right: 30px;">Admin Dashboard</a>
        <a href="/PHARMACY/Dashboards/Pharmacist_dashboard/index.php" class="btn btn-secondary">Pharmacist Dashboard</a>
      <?php endif; ?>
   
  </div>
</nav>

</header>