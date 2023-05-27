<!-- there is some error in code -->
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
    $sql="SELECT * FROM food WHERE id=$id ";
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);
    if($count==1)
    {
        $rows=mysqli_fetch_assoc($res);
        $title=$rows['title'];
        $description=$rows['description'];
        $price=$rows['price'];
        $category=$rows['category_id'];
        $image=$rows['image_name'];
        $featured=$rows['featured'];
        $active=$rows['active'];
    }
    else
    {
        $_SESSION['category_not']="<div lass='text-danger'>NO SUCH CATEGORY EXIST</div>";
        header("location:".SITEURL."admin/manage-food.php");
    }
}
else
{
    var_dump($_GET['id']);
    // header("location:".SITEURL."/admin/manage-food.php");
}
?>
    <div class="divcenter">
        <h4 class="fs-1">UPDATE FOOD</h4>
        <form action="" method="POST" enctype="multipart/form-data">
        <table class="table fs-5 table-sm " >
            <tr >
                <td>TITLE:</td>
                <td> <input type="text" name="title" value="<?php echo $title ?>"></td>
            </tr>
            <tr >
                <td>DESCRIPTION:</td>
                <td> 
                    <textarea name="description"> <?php echo $description ?>
                    </textarea>
                </td>
            </tr>
            <tr >
                <td>PRICE:</td>
                <td> <input type="number" name="price" value="<?php echo $price ?>"></td>
            </tr>
            <tr >
                <td>ORIGINAL IMAGE:</td>
                <td > 
                    <?php
                    if($image!="")
                    {
                        ?>
                        <img src="<?php echo SITEURL?>images/food-image/<?php echo $image?>"  width="100px" height="100px" alt="">
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
                                while($rows2=mysqli_fetch_assoc($res))
                                {
                                    $new_id=$rows2['id'];
                                    $new_title=$rows2['title'];
                                    ?>
                                    <option <?php if($category==$new_id){echo "selected";}?> value="<?php echo $new_id?>"><?php echo $new_title?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
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
                    <input type="hidden" name="id" value=<?php echo $id ?>>
                    <input type="hidden" name="previous-image" value=<?php echo $image ?>>
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
            $description=$_POST['description'];
            $price=$_POST['price'];
            $category=$_POST['category'];
            $previous_image=$_POST['previous-image'];
            $featured=$_POST['featured'];
            $active=$_POST['active'];

            
            

           // proccessing new image name
            if(isset($_FILES['image']['name']))
            {
                $image=$_FILES['image']['name'];
                if($image!="")
                {
                    $explode=explode('.',$image);
                    $ext=end($explode);
                    $image=$title.rand(000,999).".".$ext;
                    $source=$_FILES['image']['tmp_name'];
                    $image_destination="../images/food-image/".$image;
                    $upload=move_uploaded_file($source,$image_destination);
                    
                    if($upload==false)
                    {
                        $_SESSION['upload']="<div class='text-danger'>Image did not upload</div>";
                         header("location:".SITEURL."admin/update-food.php");
                         die(); // to stop further process 
                    }
                    
                    
                    //deleting previous image
                    if($previous_image!="")
                    {
                     $path="../images/food-image/".$previous_image;
                     $remove=unlink($path);
                        if($remove==false)
                        {
                            $_SESSION['img-delete']="<div class='text-danger'>Image not deleted </div>";
                            header("location:".SITEURL."admin/manage-food.php");
                        }
                       
                    }
                }
                else
                     $image=$previous_image;
            }
            else
               $image=$previous_image;
            $sql2="UPDATE food SET 
            title='$title',
            description='$description',
            price=$price,
            image_name='$image', 
            category_id=$category,
            featured='$featured',
            active='$active'
             WHERE id=$id ";
            $res=mysqli_query($conn,$sql2);
            if($res==true)
            {
                $_SESSION['updatef']="food updated";
                header("location:".SITEURL."admin/manage-food.php");
            }
            else
            {
                

                $_SESSION['updatef']="food not updated";
                header("location:".SITEURL."admin/manage-food.php");
            }
        }
    ?>
<?php include('partials/foot.php') ?>