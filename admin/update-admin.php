<?php include('partials/head.php') ?>

<!--  to display the value in the input box -->
<?php
    $id=$_GET['id'];
    $sql="SELECT * FROM `admin-table` WHERE id=$id";
    $res=mysqli_query($conn,$sql) or die(mysqli_error());
    if($res==TRUE)
    {
        $count=mysqli_num_rows($res);
        if($count==1)
        {
            $fetch_row=mysqli_fetch_assoc($res);
            $fullname=$fetch_row['name'];
            $username=$fetch_row['username'];
        }
    }
?>

<div class="divcenter">
    <h4 class="fs-1">UPDATE ADMIN</h4>
    <form action="" method="POST">
        <div class="row">
            <div class="col-4">
            </div>
            <div class=" mb-3 col-2">
            <span class="input-group-text">FULL NAME</span>
            <input type="text" name="fullname" class="form-control" value="<?php echo $fullname?>">
            </div> 
            <div class=" mb-3 col-2">
            <span class="input-group-text">USERNAME</span>
            <input type="text"   name="username" class="form-control" value="<?php echo $username?>">
            </div> 
        </div>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" >
            <button type="submit" name="update" class="btn btn-success  btn-lg order-last">Update</button>
    </form>
</div>    

 <!-- update the database -->
<?php
  if(isset($_POST['update']))
  {
    $id=$_POST['id'];
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $sql="UPDATE `admin-table` SET name='$fullname', username='$username' WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res==true)
    {
        $_SESSION['update']="Admin updated";
        header("location:".SITEURL."admin/manage-admin.php");
    }
    else
    {
        $_SESSION['update']="Admin not updated";
        header("location:".SITEURL."admin/manage-admin.php");
    }

  }
?>

<?php include('partials/foot.php') ?>