<?php include('partials/head.php') ?>
<div class="divcenter ">
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="table fs-5 table-sm " >
            <tr >
                <td>TITLE:</td>
                <td> <input type="text" name="title"></td>
            </tr>
            <tr >
            <td>IMAGE:</td>
                <td >
                    <input type="file" name="image" >
                </td>
            </tr>
            <tr >
                <td>FEATURED:</td>
                <td> 
                    <input type="radio" name="featured" value="YES">YES 
                    <input type="radio" name="featured" value="NO">NO 
                </td>
            </tr>
            <tr >
                <td>ACTIVE:</td>
                <td> 
                    <input type="radio" name="active" value="YES">YES 
                    <input type="radio" name="active" value="NO">NO 
                </td>
            </tr>
            
            <tr >
                <td >
                    <input type="submit" name="submit" class="btn btn-warning">
                </td>
            </tr>
        </table>
    </form>
</div>
<?php
if(isset($_POST['submit']))
{
    $title=$_POST['title'];

    if(isset($_POST['featured']))
    {
        $feature=$_POST['featured'];
        echo $feature;
    }
    else
    {
        $feature="NO";
    }

    if(isset($_POST['active']))
    {
        $active=$_POST['active'];
    }
    else
    {
        $feature="NO";
    }

    if(isset($_FILES['image']['name']))
    {
        $image_name=$_FILES['image']['name'];
        if($image_name!="")
        {     
                // rename the image
            $extension=end(explode('.',$image_name));

            $image_name_new="food".rand(000,999).".".$extension;

            // source  of image
            $image_source=$_FILES['image']['tmp_name'];

            //destination of image
            $image_destination="../images/category-image/".$image_name_new;
            
            $upload=move_uploaded_file($image_source,$image_destination);
            
            // to check image is uploaded
            if($upload==false)
            {
                $_SESSION['upload']="<div class='text-danger'>File did not upload</div>";
                header("location:".SITEURL."admin/add-category.php");
                die(); // to stop further process 
            }
        }
    }
    else
        $image_name_new=" ";
    $sql="INSERT INTO `categories` SET
    title='$title',
    `image-name`='$image_name_new',
    featured='$feature',
    active='$active'";
    $res=mysqli_query($conn,$sql) or die(mysqli_error());
    if($res==TRUE)
    {
        $_SESSION['addc']="<div class='text-success'>Category added successfully</div>";

        // redirect it to manage admin page
        header("location:".SITEURL."admin/manage-category.php");
    }
    else
    {
        $_SESSION['addc']="<div class='text-danger fs-4'>Category cannot be added</div>";

        // redirect it to manage admin page
        header("location:".SITEURL."admin/manage-category.php");   
    }
}
?>
<?php include('partials/foot.php') ?>
