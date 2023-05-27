    <!-- head start -->
    <?php include('partials/head.php') ?>
    <!-- head end -->

    <!-- main start -->
    <div class="container text-center">
        <br>
        <h3>DASHBOARD</h3>
  
  
 
<div class="row justify-content-between ">
    <div class="col-2 text-center border border-warning border-4 rounded-4 bg-light">
        <?php
        $sql="SELECT COUNT(id) FROM categories";
        $res=mysqli_query($conn,$sql);
        $fetch=mysqli_fetch_array($res);
        echo "<h3>$fetch[0]</h3>";
        ?>
      <br>
       Categories 
    </div>
    <div class="col-2 text-center border border-warning border-4 rounded-4 bg-light">
    <?php
        $sql="SELECT COUNT(id) FROM food";
        $res=mysqli_query($conn,$sql);
        $fetch=mysqli_fetch_array($res);
        echo "<h3>$fetch[0]</h3>";
        ?>
      <br>
      Foods
    </div>
    <div class="col-2 text-center border border-warning border-4 rounded-4 bg-light">
    <?php
        $sql="SELECT COUNT(id) FROM `order`";
        $res=mysqli_query($conn,$sql);
        $fetch=mysqli_fetch_array($res);
        echo "<h3>$fetch[0]</h3>";
        ?>
      <br>
      Total Orders
    </div>
    <div class="col-2 text-center  border border-warning border-4 rounded-4 bg-light" >
    <?php
        $sql="SELECT SUM(total) FROM `order` WHERE status='delivered' ";
        $res=mysqli_query($conn,$sql);
        $fetch=mysqli_fetch_array($res);
        echo "<h3>Rs.$fetch[0]</h3>";
        ?>
      <br>
      Revenue Generated
    </div>
</div>
</div>
<br>
  
    <!-- main end -->
    
    <!-- foot start -->
    <?php include('partials/foot.php') ?>
    <!-- foot end -->
 