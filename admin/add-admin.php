 <!-- head start -->
 <?php include('partials/head.php') ?>
    <!-- head end -->

    <!-- Making the variables -->
    <?php

      $fullname=$username=$password=$fullerr=$usererr=$passerr="";
    ?>

    <?php 
    if(isset($_SESSION['add']))
    {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }
    ?>
    <!-- main start -->
<div class="divcenter">
    <form action="" method="POST">
      <div class="row">
      <div class=" mb-3 col-4">
        <span class="input-group-text">FULL NAME</span>
        <input type="text" name="fullname" class="form-control ">
        <?php echo $fullerr;?>
      </div> 
      <div class=" mb-3 col-4">
        <span class="input-group-text">USERNAME</span>
        <input type="text"   name="username" class="form-control ">
        <?php echo $usererr;?>
      </div> 
      <div class=" mb-3 col-4">
        <span class="input-group-text">PASSWORD</span>
        <input type="password"   name="password" class="form-control ">
        <?php echo $passerr;?>
      </div> 
      <button type="submit" name="submit" class="btn btn-success btn-sm col-2 order-last">Submit</button>
      </div>
    </form>
</div>
    <!-- main end -->
    
    <!-- foot start -->
    <?php include('partials/foot.php') ?>
    <!-- foot end -->
 <?php
 // proccess the inputed data and save it in database
  
 // chcek submit is clicked or not
 if(isset($_POST["submit"]))
 {

   // to convert the inputed data in proper format
   function update_input($data)
   {
    $data=htmlspecialchars($data);
    $data=stripslashes($data);
    return $data;
   }

   if(empty($_POST["fullname"]))
     $fullerr= "Name is required";
   else
     $fullname=update_input($_POST["fullname"]);

   if(empty($_POST["username"]))
    $usererr= "Username is required";
   else
    $username=update_input($_POST["username"]);
    
   if(empty($_POST["password"]))
     $passerr= "Password is required";
   else
    $password=update_input($_POST["password"]);

    // sending the value in database using sql commands
    $sql=" INSERT INTO  `admin-table` SET
    name='$fullname',
    username='$username', 
    passward='$password'
    ";

    // executing the query and saving into database
    $res=mysqli_query($conn,$sql) or die(mysqli_error());

    // chcek wheather the query is executed or not
     if($res==TRUE)
     {
      $_SESSION['add']="Admin added successfully";

      // redirect it to manage admin page
      header("location:".SITEURL."admin/manage-admin.php");
     }
     else
     {
      $_SESSION['add']="failed to add admin";

      // redirect it to manage admin page
      header("location:".SITEURL."admin/add-admin.php");
     }
 }
 ?>