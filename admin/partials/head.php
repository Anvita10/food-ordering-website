<html>
<head>
    <title>admin page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
      .divcenter{
        padding:30px;
      }
    </style>
  </head>
<body>
 <?php
  include('../config/connection.php');
  include('login-check.php');
  ?>

   <nav class="navbar navbar-expand-lg bg-info px-3">
  <div class="container-fluid">
                <a href="#" title="Logo">
                    <img src="../images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
    
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav  mb-2 mb-lg-0 text-danger justify-content-center">
        <li class="nav-item">
          <a class="nav-link active text-danger p-3 fs-3"  href="admin.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger p-3 fs-3" href="manage-admin.php">Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger p-3 fs-3" href="manage-category.php">Category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger p-3 fs-3" href="manage-food.php">Food</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger p-3 fs-3" href="manage-order.php">Order</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger  p-3 fs-3" href="#">Contact</a>
        </li>  
        <li class="nav-item">
          <a class="nav-link text-danger  p-3 fs-3" href="logout.php">Logout</a>
        </li>  
      </ul>
    </div>
  </div>
</nav>