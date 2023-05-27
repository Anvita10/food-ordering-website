<?php include('partials/head.php') ?>
<div class="divcenter ">
<?php
     if(isset($_SESSION['uploadf']))
     {
       echo $_SESSION['uploadf'];
       unset($_SESSION['uploadf']);
     }
?>
<form action="" method="POST" enctype="multipart/form-data">
        <table class="table fs-5 table-sm " >
            <tr >
                <td>TITLE:</td>
                <td> <input type="text" name="title"></td>
            </tr>
            <tr >
                <td>DESCRITION:</td>
                <td> <textarea cols="40" rows="8" name="description"></textarea> </td>
            </tr>
            <tr >
                <td>PRICE(Rs.):</td>
                <td> <input type="number" name="price"></td>
            </tr>
            <tr >
            <td>IMAGE:</td>
                <td >
                    <input type="file" name="image" >
                </td>
            </tr>
            <tr >
                <td>CATEGORY:</td>
                <td> 
                    <select name="category">
                        <?php
                        $sql="SELECT * FROM categories WHERE active='YES' ";
                        $res=mysqli_query($conn,$sql);
                        if($res==TRUE)
                        {
                            $count=mysqli_num_rows($res);
                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id=$rows['id'];
                                    $title=$rows['title'];
                                    ?>
                                    <option value="<?php echo $id?>"><?php echo $title?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <option value="0"  disabled>No category found</option>
                                <?php
                            }
                        }
                        ?>
                        
                    </select>
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
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category=$_POST['category'];

    if(isset($_POST['featured']))
        $feature=$_POST['featured'];
    else
        $feature="NO";

    if(isset($_POST['active']))
        $active=$_POST['active'];
    else
        $feature="NO";

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
            $image_destination="../images/food-image/".$image_name_new;
            
            $upload=move_uploaded_file($image_source,$image_destination);
            
            // to check image is uploaded
            if($upload==false)
            {
                $_SESSION['uploadf']="<div class='text-danger'>File did not upload</div>";
                header("location:".SITEURL."admin/add-food.php");
                die(); // to stop further process 
            }
        }
    }
    else
        $image_name_new=" ";
    $sql="INSERT INTO `food` SET
    title='$title',
    description='$description',
    price=$price,
    image_name='$image_name_new',
    category_id=$category,
    featured='$feature',
    active='$active'";
    $res=mysqli_query($conn,$sql) or die(mysqli_error());
    if($res==TRUE)
    {
        $_SESSION['addf']="<div class='text-success'>Food added successfully</div>";

        // redirect it to manage admin page
        header("location:".SITEURL."admin/manage-food.php");
    }
    else
    {
        $_SESSION['addf']="<div class='text-danger fs-4'>Food cannot be added</div>";

        // redirect it to manage admin page
        header("location:".SITEURL."admin/manage-food.php");   
    }
}
?>
<?php include('partials/foot.php') ?>
