<?php include('partials-front/menu.php') ?>

<?php
if(isset($_SESSION['updated']))
{
    echo $_SESSION['updated'];
    unset($_SESSION['updated']);
}
if(isset($_SESSION['wrongid']))
{
    echo $_SESSION['wrongid'];
    unset($_SESSION['wrongid']);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            $sql="SELECT * FROM categories  WHERE featured='YES' AND active='YES' LIMIT 3";
            $res=mysqli_query($conn,$sql);
            if($res==true)
            {
                $count=mysqli_num_rows($res);
                
                if($count>0)
                {
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        ?>
                            <a href="<?php echo SITEURL;?>category-foods.php?id=<?php echo $rows['id']?>">
                        <div class="box-3 float-container">
                            <?php
                         if($rows['image-name']=="")
                         {
                            echo "<div class='bg-red text-light>Image not availabe</div>";
                         }
                         else
                         {
                            ?>
                             <img src="<?php echo SITEURL?>images/category-image/<?php echo $rows['image-name']?>" alt="<?php echo $rows['title']?>" class="img-responsive img-curve" width="200px" height="300px">
                             <h3 class="float-text text-white"><?php echo $rows['title']?></h3>
                             <?php
                         }
                         ?>   
                        </div>
                        </a>
                        <?php
                    }
                }
            }
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            $sql1="SELECT * from food WHERE featured='YES' AND active='YES' LIMIT 6";
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

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/foot.php') ?>
