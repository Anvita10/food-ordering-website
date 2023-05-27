<?php include('partials/head.php') ?>

<div class="divcenter">
        <h4 class="fs-1">UPDATE ORDER</h4>
        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
            $sql="SELECT * FROM `order` WHERE id=$id";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            if($count==1)
            {
                $rows=mysqli_fetch_assoc($res);
                $food=$rows['food'];
                $price=$rows['price'];
                $quantity=$rows['qty'];
                $status=$rows['status'];
                $name=$rows['customer_name'];
                $contact=$rows['customer_contact'];
                $email=$rows['customer_email'];
                $address=$rows['customer_address'];
            }
            else{
                header("location:".SITEURL."admin/manage-order.php");
            }

        }
        else{
            header("location:".SITEURL."admin/manage-order.php");
        }
        ?>
        <form action="" method="POST">
            <table class="table " >
            <tr >
                    <td>FOOD:</td>
                    <td><b><?php echo $food ?></b></td>
            </tr>
            <tr >
                    <td>PRICE:</td>
                    <td><b>Rs.<?php echo $price ?></td>
            </tr>
        <tr>
            <td>CATEGORY:</td>
            <td>
            <select name="status">
                <option <?php if($status=="ordered") echo "selected"?> value="orderded">ordered</option>
                <option <?php if($status=="on delivery") echo "selected"?> value="on delivery">on delivery</option>
                <option <?php if($status=="delivered") echo "selected"?> value="delivered">delivered</option>
                <option <?php if($status=="cancelled") echo "selected"?> value="cancelled">cancelled</option>
            </select>
            </td>
         </tr>
            <tr >
                    <td>QUANTITY:</td>
                    <td> <input type="number" name="qty" value="<?php echo $quantity ?>"></td>
            </tr>
            <tr >
                    <td>CUSTOMER NAME:</td>
                    <td> <input type="text" name="customer-name" value="<?php echo $name ?>"></td>
            </tr>
            <tr >
                    <td>CUSTOMER CONTACT:</td>
                    <td> <input type="text" name="customer-contact" value="<?php echo $contact ?>"></td>
            </tr>
            <tr >
                    <td>CUSTOMER EMAIL:</td>
                    <td> <input type="text" name="customer-email" value="<?php echo $email ?>"></td>
            </tr>
            <tr >
                    <td>CUSTOMER ADDRESS:</td>
                    <td> 
                        <textarea name="customer-address"><?php echo $address ?></textarea>
                    </td>
              </tr>
              <tr>           
                <td>
                <input type="hidden" name="id" value="<?php echo $id; ?>">   
                <input type="hidden" name="price" value="<?php echo $price; ?>">   
                <input type="submit" name="submit" class="btn btn-warning">   
                </td>
            </tr>
            </table>
        </form>
        <?php
        if(isset($_POST['submit']))
        {
            $id=$_POST['id'];
            $price=$_POST['price'];
            $quantity=$_POST['qty'];
            $total=$price*$quantity;
            $status=$_POST['status'];
            $name=$_POST['customer-name'];
            $contact=$_POST['customer-contact'];
            $email=$_POST['customer-email'];
            $address=$_POST['customer-address'];

            $sql1="UPDATE `order` SET 
            price=$price,
            qty=$quantity,
            total=$total,
            status='$status',
            customer_name='$name',
            customer_contact='$contact',
            customer_email='$email',
            customer_address='$address'
            WHERE id=$id";

            $res1=mysqli_query($conn,$sql1);
            if($res1==true)
            {
                $_SESSION['update']="<div class='text-success'>Updated successfully</div>";
                header("location:".SITEURL."admin/manage-order.php");
            }
            else
            {
                $_SESSION['update']="<div class='text-danger'>Not Updated </div>";
                header("location:".SITEURL."admin/manage-order.php");

            }
        }
        
        ?>
    </div>
    <?php include('partials/foot.php') ?>
