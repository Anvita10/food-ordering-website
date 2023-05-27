<?php include('partials/head.php') ?>
<div class="divcenter">
    <h4 class="fs-1">Manage Category</h4>
    <?php
     if(isset($_SESSION['addc']))
     {
       echo $_SESSION['addc'];
       unset($_SESSION['addc']);
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
     if(isset($_SESSION['updatec']))
     {
       echo $_SESSION['updatec'];
       unset($_SESSION['updatec']);
     }
    ?>
    <br/> 
    <a class="btn btn-success btn-lg fs-5" href="add-category.php" role="button">Add Category</a>
    <br></br>
    <table class="table table-success table-striped-columns">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">title</th>
      <th scope="col">image-name</th>
      <th scope="col">Featured</th>
      <th scope="col">Active</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
    <?php
    $sql="SELECT * FROM `categories`";
    $res=mysqli_query($conn,$sql);
    if($res==true)
    {
        $count=mysqli_num_rows($res);
        if($count>0)
        {
            $i=0;
            while($rows=mysqli_fetch_assoc($res))
            {
                $title=$rows['title'];
                $image=$rows['image-name'];
                $featured=$rows['featured'];
                $active=$rows['active'];
                $i++;
                ?>
                <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $title?> </td>
                    <td>
                      <?php
                      if($image=="")
                         echo $image;
                      else
                        {
                          ?>
                          <img src="<?php echo SITEURL?>images/category-image/<?php echo $image ?>" width="100px" height="100px" alt="">
                          <?php
                        }
                      ?>
                    </td>
                    <td><?php echo $featured ?></td>
                    <td><?php echo $active ?></td>
                    <td>
                        <a  href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $rows['id'];?>" class="btn btn-outline-danger fs-5">UPDATE</a>
                        <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $rows['id'];?>&image=<?php echo $image ?>" class="btn btn-outline-danger fs-5">DELETE</a>
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