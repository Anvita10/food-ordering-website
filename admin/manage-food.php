<?php include('partials/head.php') ?>
<div class="divcenter">
    <h4 class="fs-1">Manage Food</h4>
    <?php
     if(isset($_SESSION['addf']))
     {
       echo $_SESSION['addf'];
       unset($_SESSION['addf']);
     }
     
     if(isset($_SESSION['deletec']))
     {
       echo $_SESSION['deletec'];
       unset($_SESSION['deletec']);
     }
     if(isset($_SESSION['img-delete']))
     {
       echo $_SESSION['img-delete'];
       unset($_SESSION['img-delete']);
     }
     if(isset($_SESSION['category_not']))
     {
       echo $_SESSION['category_not'];
       unset($_SESSION['category_not']);
     }
     if(isset($_SESSION['updatef']))
     {
       echo $_SESSION['updatef'];
       unset($_SESSION['updatef']);
     }
     ?>
    <br/> 
    <a class="btn btn-success btn-lg fs-5" href="add-food.php" role="button">Add Food</a>
    <br></br>
    <table class="table table-success table-striped-columns">
        <thead>
            <tr>
            <th scope="col">SNO.</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th scope="col">Featured</th>
            <th scope="col">Active</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <?php
    $sql="SELECT * FROM `food`";
    $res=mysqli_query($conn,$sql);
    if($res==true)
    {
        $count=mysqli_num_rows($res);
        if($count>0)
        {
            $i=1;
            while($rows=mysqli_fetch_assoc($res))
            {
                $image=$rows['image_name'];
                ?>
                <tr>
                    <th scope="row"><?php echo $i++ ?></th>
                    <td><?php echo $rows['title']?> </td>
                    <td><?php echo $rows['description']?></td>
                    <td><?php echo $rows['price']?></td>
                    <td>
                    <?php
                      if($image=="")
                         echo $image;
                      else
                        {
                          ?>
                          <img src="<?php echo SITEURL?>images/food-image/<?php echo $image ?>" width="100px" height="100px" alt="">
                          <?php
                        }
                      ?>
                    </td>
                    <td><?php echo $rows['featured'] ?></td>
                    <td><?php echo $rows['active'] ?></td>
                    <td>
                        <a  href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $rows['id'];?>" class="btn btn-outline-danger fs-5">UPDATE</a>
                        <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $rows['id'];?>&image=<?php echo $image ?>" class="btn btn-outline-danger fs-5">DELETE</a>
                    </td>
                </tr>
            <?php
            }
        }
    }
    ?>
    </table>
</div>
<?php include('partials/foot.php') ?>
