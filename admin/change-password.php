<?php include('partials/head.php') ?>

 <div class="divcenter">
    <?php
    if(isset($_SESSION['passward_change']))
        {
        echo $_SESSION['passward_change'];
        unset($_SESSION['passward_change']);
        }
    ?>    
    <form action="" method="POST">
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label fs-4">Original Password</label>
            <div class="col-sm-10">
                <br/>
            <input type="password" name="ori_pass" class="form-control-sm" id="inputPassword">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label fs-4">New Password</label>
            <div class="col-sm-10">
                <br/>
            <input type="password" name="new_pass" class="form-control-sm" id="inputPassword">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label fs-4">Confirm Password</label>
            <div class="col-sm-10">
                <br/>
            <input type="password" name="confirm_pass" class="form-control-sm" id="inputPassword">
            </div>
        </div>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <button type="submit" name="submit" class="btn btn-success btn-sm col-2 order-last">Submit</button>
    </form>
 </div> 
<?php 
    if(isset($_POST['submit']))
    {
        $id=$_POST['id'];
        $ori=$_POST['ori_pass'];
        $new_ori=$_POST['new_pass'];
        $confirm_ori=$_POST['confirm_pass'];

        $sql="SELECT * FROM `admin-table` WHERE id=$id AND passward='$ori' ";
        $res=mysqli_query($conn,$sql);
        if($res==true)
        {
            $count=mysqli_num_rows($res);
            if($count==1)
            {
                if($new_ori==$confirm_ori)
                {
                    $sql2="UPDATE `admin-table`SET passward='$new_ori' WHERE id=$id AND passward='$ori' ";
                    $res=mysqli_query($conn,$sql2);
                    $_SESSION['passward_change']="Passward changed successfully";
                    header("location:".SITEURL."/admin/manage-admin.php");
                }
                else
                {
                    $_SESSION['passward_change']="Incorrect new passward";
                    header("location:".SITEURL."/admin/change-password.php");
                }
            }
            else
            {
                $_SESSION['passward_change']="User not found";
                header("location:".SITEURL."/admin/manage-admin.php");

            }
        }    
    }

?>
<?php include('partials/foot.php') ?>
