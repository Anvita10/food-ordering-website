<?php include('partials-front/menu.php') ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            $sql="SELECT * FROM categories  WHERE  active='YES'";
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


    <?php include('partials-front/foot.php') ?>
