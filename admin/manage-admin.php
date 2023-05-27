    <!-- head start -->
  <?php include('partials/head.php') ?>
    <!-- head end -->

    <!-- main start -->
    <div class="divcenter">
    <h4 class="fs-1">Manage Admin</h4>
    
    <?php 
    if(isset($_SESSION['add']))
    {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }

    if(isset($_SESSION['delete']))
    {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }
    
    if(isset($_SESSION['update']))
    {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }

    if(isset($_SESSION['passward_change']))
    {
      echo $_SESSION['passward_change'];
      unset($_SESSION['passward_change']);
    }
    ?>
    <br/> 
    <a class="btn btn-success btn-lg fs-5" href="add-admin.php" role="button">Add Admin</a>
    <br></br>
    <table class="table table-success table-striped-columns table-hover">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Full Name</th>
      <th scope="col">Username</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <?php
  // query to get all admin
   $sql="SELECT * FROM `admin-table`";
   //execute query
   $res=mysqli_query($conn,$sql);

   // checking query executed or not
   if($res==true)
   {
    // counting the number of rows
    $count=mysqli_num_rows($res);
    if($count>0)
    {
      // we have data in database
      $i=0;
      while($rows=mysqli_fetch_assoc($res))
      {
        // it will fetch data rowwise
        $id=$rows['id'];
        $name=$rows['name'];
        $username=$rows['username'];
        $i++;
        ?>
    <tr>
      <th scope="row"><?php echo $i ?> </th>
      <td><?php echo $name ?> </td>
      <td><?php echo $username ?></td>
      <td>
        <a  href="<?php echo SITEURL;?>admin/change-password.php?id=<?php echo $id; ?>" class="btn btn-outline-danger fs-6">CHANGE PASSWORD</a>
        <a  href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn btn-outline-danger fs-5">UPDATE</a>
        <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn btn-outline-danger fs-5">DELETE</a>
      </td>
    </tr>
    <?php
      }
    }
   }

  ?>
</table>
</div>
    <!-- main end -->
    
    <!-- foot start -->
    <?php include('partials/foot.php') ?>
    <!-- foot end -->