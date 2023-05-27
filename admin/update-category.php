// there is some error
<?php include('partials/head.php') ?>
<?php
if(isset($_SESSION['upload']))
{
  echo $_SESSION['upload'];
  unset($_SESSION['upload']);
}
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql="SELECT * FROM categories WHERE id=$id ";
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);
    if($count==1)
    {
        $rows=mysqli_fetch_assoc($res);
        $title=$rows['title'];
        $image=$rows['image-name'];
        $featured=$rows['featured'];
        $active=$rows['active'];
    }
    else
    {
        $_SESSION['category_not']="<div class='text-danger'>NO SUCH CATEGORY EXIST</div>";
        header("location:".SITEURL."admin/manage-category.php");
    }
}
else
{
    var_dump($_GET['id']);
    // $_SESSION['category_not']="<div class='text-danger'> CATEGORY EXIST</div>";

    // header("location:".SITEURL."/admin/manage-category.php");
}
?>
    <div class="divcenter">
        <h4 class="fs-1">UPDATE CATEGORY</h4>
        <form action="" method="POST" enctype="multipart/form-data">
        <table class="table fs-5 table-sm " >
            <tr >
                <td>TITLE:</td>
                <td> <input type="text" name="title" value="<?php echo $title ?>"></td>
            </tr>
            <tr >
                <td>ORIGINAL IMAGE:</td>
                <td > 
                    <?php
                    if($image!="")
                    {
                        ?>
                        <img src="<?php echo SITEURL?>images/category-image/<?php echo $image?>"  width="100px" height="100px" alt="">
                        <?php
                    }
                     else
                      echo "<div class='text-success'>There is no image</div>"; 
                    ?>
                </td>
            </tr>
            <tr>
            <td>NEW IMAGE:</td>
                <td >
                    <input type="file" name="image">
                </td>
            </tr>
            <tr >
                <td>FEATURED:</td>
                <td> 
                    <input <?php if($featured=="YES") echo "checked"?> type="radio" name="featured" value="YES">YES 
                    <input <?php if($featured=="NO") echo "checked"?> type="radio" name="featured" value="NO">NO 
                </td>
            </tr>
            <tr >
                <td>ACTIVE:</td>
                <td> 
                    <input <?php if($active=="YES") echo "checked"?> type="radio" name="active" value="YES">YES 
                    <input  <?php if($active=="NO") echo "checked"?> type="radio" name="active" value="NO">NO 
                </td>
            </tr>
            
            <tr >
                <td >
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <input type="hidden" name="previous-image" value="<?php echo $image ?>">
                    <input type="submit" name="submit" class="btn btn-warning">
                </td>
            </tr>
            </table>
        </form>
    </div>
    <?php
        if(isset($_POST['submit']))
        {
            $id=$_POST['id'];
            $title=$_POST['title'];
            $previous_image=$_POST['previous-image'];
            $featured=$_POST['featured'];
            $active=$_POST['active'];

            // proccessing new image name
            if(isset($_FILES['image']['name']))
            {
                $image=$_FILES['image']['name'];
                $explode=explode('.',$image);
                $ext=end($explode);
                $image=$title.rand(000,999).".".$ext;
                $source=$_FILES['image']['tmp_name'];
                $image_destination="../images/category-image/".$image;
                $upload=move_uploaded_file($source,$image_destination);
                
                if($upload==false)
                {
                    $_SESSION['upload']="<div class='text-danger'>File did not upload</div>";
                    header("location:".SITEURL."admin/update-category.php");
                    die(); // to stop further process 
                }

                // deleting previous image
                if($previous_image!="")
                {
                 $path="../images/category-image/".$previous_image;
                 $remove=unlink($path);
                    if($remove==false)
                    {
                        $_SESSION['img-delete']="<div class='text-danger'>image not deleted </div>";
                        header("location:".SITEURL."/admin/manage-category.php");
                    }
                }
                else
               $image=$previous_image;
            }
            else
               $image=$previous_image;

            $sql2="UPDATE `categories` SET 
            title='$title',
            `image-name`='$image', 
            featured='$featured',
            active='$active'
             WHERE id=$id ";
            $res=mysqli_query($conn,$sql2);
            if($res==true)
            {
                $_SESSION['updatec']="Category updated";
                header("location:".SITEURL."admin/manage-category.php");
            }
            else
            {
                $_SESSION['updatec']="Category not updated";
                header("location:".SITEURL."admin/manage-category.php");
            }
         }
    ?>
<?php include('partials/foot.php') ?>
