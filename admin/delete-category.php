<?php
include('../config/connection.php');
if(isset($_GET['id']) AND isset($_GET['image']))
{
    $id=$_GET['id'];
    $image=$_GET['image'];

    // removing image from images folder
    if($image!="")
    {
        $path="../images/category-image/".$image;
        $remove=unlink($path);
         if($remove==false)
        {
                $_SESSION['img-delete']="<div class='text-danger'>image not deleted </div>";
                header("location:".SITEURL."/admin/manage-category.php");
        }
       
    }

    $sql="DELETE FROM categories WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res==true)
    {
            $_SESSION['deletec']="<div class='text-success'>category deleted successfully</div>";
            header("location:".SITEURL."/admin/manage-category.php");
    }
    else
    {
    $_SESSION['deletec']="<div class='text-danger'>category not deleted</div>";
    header("location:".SITEURL."/admin/manage-category.php");
    }
}
else
{
    header("location:".SITEURL."/admin/manage-category.php");
}

?>