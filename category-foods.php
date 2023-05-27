<?php include('partials-front/menu.php') ?>
<?php
if(!isset($_GET['id']))
header("location:".SITEURL);
else
{
    $id=$_GET['id'];
    $sql1="SELECT title from categories WHERE id=$id";
    $res1=mysqli_query($conn,$sql1);
    $rows1=mysqli_fetch_assoc($res1);
    $category=$rows1['title'];

}
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on 
                <a href="#" class="text-white">"<?php echo $category ?>"</a></h2>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            $sql1="SELECT * from food WHERE `category_id`=$id";
            $res1=mysqli_query($conn,$sql1);
            if($res1==true)
            {
                $count1=mysqli_num_rows($res1);
                if($count1>0)
                {
                    while($rows1=mysqli_fetch_assoc($res1))
                    {
                        $id=$rows1['id'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                if($rows1['image_name']!="")
                                {
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/food-image/<?php echo $rows1['image_name'];?>" alt="<?php echo $rows1['title'] ?>" class="img-responsive img-curve"  width="300px" height="100px">
                                    <?php
                                }
                                else
                                echo "<div>Image not availabe</div>";   
                                ?>
                            </div>
                            <div class="food-menu-desc">
                                <h4><?php echo $rows1['title']?></h4>
                                <p class="food-price">Rs.<?php echo $rows1['price']?></p>
                                <p class="food-detail"><?php echo $rows1['description']?></p>
                                <br>
                                <a href="<?php echo SITEURL;?>order.php?id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                echo "<div>Food not availabe</div>";        
            }
            else
            echo "<div class='bg-red text-light>Food not availabe</div>";
            ?>
          

            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/foot.php') ?>
 