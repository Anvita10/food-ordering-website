<?php include('partials-front/menu.php') ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on Your Search 
                <?php
                // to protect the data feom sql injection (hacking) we will use mysqli_real_escape_string which convert incoming data to string.
                $find=mysqli_real_escape_string($conn,$_POST['search']);
                ?>
                <a href="#" class="text-white"><?php echo $find ?></a>
                
            </h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
                <?php
                if(isset($_POST['submit']))
                {
                    $find=$_POST['search'];
                    $sql="SELECT * FROM food WHERE title LIKE '%$find%' OR description LIKE '%$find%' ";
                    $res=mysqli_query($conn,$sql);
                    if($res==true)
                    {
                        $count=mysqli_num_rows($res);
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                ?>
                                <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <?php
                                        if($row['image_name']!="")
                                        {
                                            ?>
                                        <img src="<?php echo SITEURL?>images/food-image/<?php echo $row['image_name']?>" alt="<?php echo $row['image_name']?>" class="img-responsive img-curve" width="300px" height="100px">
                                    <?php    
                                        }
                                        else
                                        echo "<div class='text-danger'>Image not available</div>";
                                        ?>
                                    </div>
                                    <div class="food-menu-desc">
                                        <h4><?php echo $row['title']?></h4>
                                        <p class="food-price">Rs.<?php echo $row['price']?></p>
                                        <p class="food-detail"><?php echo $row['description']?></p>
                                        <br>
                                        <a href="#" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        else
                        {
                            echo "<div class='text-danger'>NO FOOD FOUND</div>";
                        }

                    }
                }
                ?>



                


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/foot.php') ?>
 