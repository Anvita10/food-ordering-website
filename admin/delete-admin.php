
<?php
    include("../config/connection.php");
  // fetch the incoming id from the url
  if(isset($_GET['id']))
  {
    $id=$_GET['id'];

    // sql query to delete the row
    $sql="DELETE  FROM `admin-table` WHERE id=$id";

    // executing the query
    $res=mysqli_query($conn,$sql);

    // checking the query is executed or not
    if($res==TRUE)
    {
      // creating session variable to display the message
      $_SESSION['deletec']="<div>Admin deleted successfully</div>";
      
      // redirecting to manage-admin
      header("location:".SITEURL."/admin/manage-admin.php");
    }
    else
    {
    // creating session variable to display the message
    $_SESSION['deletec']="<div >Admin not deleted</div>";
    
    // redirecting to manage-admin
    header("location:".SITEURL."/admin/manage-admin.php");

     }
  }
  else
  {
    header("location:".SITEURL."/admin/manage-admin.php");
  }
?>