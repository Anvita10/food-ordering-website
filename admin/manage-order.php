   <!-- head start -->
   <?php include('partials/head.php') ?>
    <!-- head end -->

    <!-- main start -->
    <div class="divcenter">
    <h4 class="fs-1">Manage Order</h4>
<?php
if(isset($_SESSION['update']))  
{
  echo $_SESSION['update'];
  unset($_SESSION['update']) ;
} 
?> 
    <br></br>
    <table class="table table-success table-striped-columns table-hover">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Food</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total</th>
      <th scope="col">Order date</th>
      <th scope="col">Status</th>
      <th scope="col">Customer name</th>
      <th scope="col">Customer contact</th>
      <th scope="col">Customer email</th>
      <th scope="col">Customer address</th>
      <th scope="col">Action</th>

    </tr>
    <?php
    $sql="SELECT * FROM `order` ORDER BY `order_date` DESC";
    $res=mysqli_query($conn,$sql);

    if($res==true)
    {
        $count=mysqli_num_rows($res);
        if($count>0)
        {
            $i=1;
            while($rows=mysqli_fetch_assoc($res))
            {
                $id=$rows['id'];
                $title=$rows['food'];
                $price=$rows['price'];
                $quantity=$rows['qty'];
                $total=$rows['total'];
                $date=$rows['order_date'];
                $status=$rows['status'];
                $name=$rows['customer_name'];
                $contact=$rows['customer_contact'];
                $email=$rows['customer_email'];
                $address=$rows['customer_address'];
                ?>
                <tr>
                    <td><?php echo $i++;?></td>
                    <td><?php echo $title;?></td>
                    <td><?php echo $price;?></td>
                    <td><?php echo $quantity;?></td>
                    <td><?php echo $total;?></td>
                    <td><?php echo $date;?></td>
                    <td>
                      <?php
                      if($status=="ordered")
                        echo "<div class='text-info'>$status</div>";
                       elseif($status=="delivered") 
                       echo "<div class='text-success'>$status</div>";
                       elseif($status=="on delivery") 
                       echo "<div class='text-warning'>$status</div>";
                       else
                       echo "<div class='text-danger'>$status</div>";
                       ?>
                    </td>
                    <td><?php echo $name;?></td>
                    <td><?php echo $contact;?></td>
                    <td><?php echo $email;?></td>
                    <td><?php echo $address;?></td>
                    <td>
                    <a  href="<?php echo SITEURL ;?>admin/update-order.php?id=<?php echo $id;?>" class="btn btn-outline-danger fs-5">UPDATE</a>

                    </td>
                </tr>
                <?php
            }
        }
    }
    ?>
  </thead>
  </table>
</div>
    <!-- main end -->
    
    <!-- foot start -->
    <?php include('partials/foot.php') ?>
    <!-- foot end -->