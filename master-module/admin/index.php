<?php
include "includes/head.php";
include "index.css";
?>

<body>

  <?php
  include "includes/header.php";
  ?>

  <div class=" container-fluid">

    <?php
    include "includes/sidebar.php";
    ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <br>
      <div class="row">
        <div class="card" style="width: 25rem;margin-bottom: 20px ;margin-right: 100px ;">
          <a href="orders.php">
            <img class="card-img-top" src="../images/shopping-cart.svg" alt="Card image cap" style="width: 5rem;margin-top: 20px ;">
          </a>
          <div class="card-body">
            <h5 class="card-title">Orders</h5>
            <p class="card-text">Display and modify the orders details.</p>
            <a href="orders.php" class="btn btn-primary">Go to orders page</a>
          </div>
        </div>
        <div class="card" style="width: 25rem;margin-bottom: 20px ; margin-right:100px;">
          <a href="products.php">
            <img class="card-img-top" src="../images/package.svg" alt="Card image cap" style="width: 5rem;margin-top: 20px ;">
          </a>
          <div class="card-body">
            <h5 class="card-title">Products</h5>
            <p class="card-text">Display and modify the products details.</p>
            <a href="products.php" class="btn btn-primary">Go to products page</a>
          </div>
        </div>
        <div class="card" style="width: 25rem;margin-bottom: 20px ;">
          <a href="../../sales_management/sales.php">
            <img class="card-img-top" src="../images/sale-management.svg" alt="Card image cap" style="width: 5rem;margin-top: 20px ;">
          </a>
          <div class="card-body">
            <h5 class="card-title">Sales</h5>
            <p class="card-text">Manage the sales.</p>
            <a href="../../sales_management/sales.php" class="btn btn-primary">Go to sales mgt page</a>
          </div>
        </div>
      </div>
    
      <div class="row">
        <div class="card" style="width: 25rem;margin-top: 20px; margin-bottom:20px; margin-right: 100px ;">
          <a href="customers.php">
            <img class="card-img-top" src="../images/users.svg" alt="Card image cap" style="width: 5rem;margin-top: 20px ;">
          </a>
          <div class="card-body">
            <h5 class="card-title">Customers</h5>
            <p class="card-text">Display and modify the customers details.</p>
            <a href="customers.php" class="btn btn-primary">Go to customers page</a>
          </div>
        </div>
        <div class="card" style="width: 25rem;margin-bottom:20px; margin-right:100px;">
          <a href="admin.php">
            <img class="card-img-top" src="../images/user.svg" alt="Card image cap" style="width: 5rem;margin-top: 20px ;">
          </a>
          <div class="card-body">
            <h5 class="card-title">Admin</h5>
            <p class="card-text">Display and modify the admins details.</p>
            <a href="admin.php" class="btn btn-primary">Go to admin page</a>
          </div>
        </div>
        <div class="card" style="width: 25rem;margin-bottom: 20px ;">
          <a href="../../users_management/users.php">
            <img class="card-img-top" src="../images/user-management.svg" alt="Card image cap" style="width: 5rem;margin-top: 20px ;">
          </a>
          <div class="card-body">
            <h5 class="card-title">Users</h5>
            <p class="card-text">Manage the users.</p>
            <a href="../../users_management/users.php" class="btn btn-primary">Go to users mgt page</a>
          </div>
        </div>
      </div>
      <div class="row">
       <div class="card" style="width: 25rem;margin-bottom: 20px ; margin-top:20px; margin-right: 100px;">
          <a href="/PHARMACY/doctors_management/doctors.php">
            <img class="card-img-top" src="../images/doctors-management.svg" alt="Card image cap" style="width: 5rem;margin-top: 20px ;">
          </a>
          <div class="card-body">
            <h5 class="card-title">Doctors</h5>
            <p class="card-text">Manage the doctors.</p>
            <a href="/PHARMACY/doctors_management/doctors.php" class="btn btn-primary">Go to doctors mgt page</a>
          </div>
        </div>
        <div class="card" style="width: 25rem; margin-bottom: 20px ;margin-top: 20px ; margin-right:100px">
          <a href="../../inventory_management/inventory.php">
            <img class="card-img-top" src="../images/inventory-management.svg" alt="Card image cap" style="width: 5rem;margin-top: 20px ;">
          </a>
          <div class="card-body">
            <h5 class="card-title">Inventory</h5>
            <p class="card-text">Manage the inventory.</p>
            <a href="../../inventory_management/inventory.php" class="btn btn-primary">Go to inventory mgt page</a>
          </div>
        </div>
        <div class="card" style="width: 25rem;margin-bottom: 20px ; margin-top:20px;">
          <a href="../../reports_management/reports.php">
            <img class="card-img-top" src="../images/report-management.svg" alt="Card image cap" style="width: 5rem;margin-top: 20px ;">
          </a>
          <div class="card-body">
            <h5 class="card-title">Reports</h5>
            <p class="card-text">Manage the reports.</p>
            <a href="../../reports_management/reports.php" class="btn btn-primary">Go to prescriptions mgt page</a>
          </div>
        </div>
      </div>

    <div class="row">
      <div class="card" style="width: 25rem; margin-bottom: 20px ;margin-right: 100px;">
          <a href="../../pharmacy_management/pharmacy.php">
            <img class="card-img-top" src="../images/pharmacy-management.svg" alt="Card image cap" style="width: 5rem;margin-top: 20px ;">
          </a>
          <div class="card-body">
            <h5 class="card-title">Pharmacy</h5>
            <p class="card-text">Manage the pharmacy.</p>
            <a href="../../pharmacy_management/pharmacy.php" class="btn btn-primary">Go to pharmacy mgt page</a>
          </div>
      </div>
    <div class="card" style="width: 25rem;margin-bottom: 20px ; margin-right:100px;">
          <a href="../../prescriptions_management/prescriptions.php">
            <img class="card-img-top" src="../images/prescription-management.svg" alt="Card image cap" style="width: 5rem;margin-top: 20px ;">
          </a>
          <div class="card-body">
            <h5 class="card-title">Prescriptions</h5>
            <p class="card-text">Manage the prescriptions.</p>
            <a href="../../prescriptions_management/prescriptions.php" class="btn btn-primary">Go to prescriptions mgt page</a>
          </div>
      </div>
    </div>

  </main>
</div>

  <?php
  include "includes/footer.php"
  ?>
</body>

</html>