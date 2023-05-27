<?php include('partials-front/menu.php') ?>
<?php
if(isset($_GET['id']))
{
    $id=$_GET['id']; 
    $sql="SELECT * FROM food WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res==true)
    {
        $count=mysqli_num_rows($res);
        if($count==1)
        {
            $rows=mysqli_fetch_assoc($res);
            $title=$rows['title'];
            $price=$rows['price'];
            $image=$rows['image_name'];
            $featured=$rows['featured'];
            $active=$rows['active'];
        }
        else
        {
            $_SESSION['wrongid']="<div class='text-danger'>WRONG INPUT ID<div>";
             header("location:".SITEURL);
        }
    }
}
else
{
   header("location:".SITEURL);
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        if($image!="")
                        {
                            ?>
                        <img src="<?php echo SITEURL;?>images/food-image/<?php echo $image;?>" alt="<?php echo $title ?>" class="img-responsive img-curve" width="300px" height="100px">
                            <?php
                        }
                        else
                        echo "<div class='text-danger'>Image not available</div>";
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">Rs.<?php echo $price ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
     <?php
    if(isset($_POST['submit']))
    {
        $title=$_POST['food'];
        $price=$_POST['price'];
        $quantity=$_POST['qty'];
        $total=$quantity*$price;
        $date=date("Y/m/d");
        $status="ordered";
        $name=$_POST['full-name'];
        $contact=$_POST['contact'];
        $email=$_POST['email'];
        $address=$_POST['address'];

       $sql1="INSERT INTO `order` SET 
        food='$title',
        price=$price,
        qty=$quantity,
        total=$total,
        order_date='$date',
        status='$status',
        customer_name='$name',
        customer_contact='$contact',
        customer_email='$email',
        customer_address='$address'
        ";

        
        $res1=mysqli_query($conn,$sql1);
        if($res1==true)
        {
            $_SESSION['updated']="<div class='text-success text-center'>Order placed successfully</div>";
            header("location:".SITEURL);
        }
        else
        {
            $_SESSION['updated']="<div class='text-danger text-center'>Order cannot be placed</div>";
            header("location:".SITEURL); 
        }
    }
    ?> 

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/foot.php') ?>
 