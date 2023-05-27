<html>
    <head>
        <title>Food-order-login-system</title>
        <style>
            #login{
                border: 2px solid black;
                width:30%;
                border-radius:20px;
                margin:5% auto;
                padding:2%;
                text-align:center;
            }
            .color{
                color:red;
            }
            .button
            {
                font-size:30px;
                background-color:blue;
                border-radius:40%;
            }
            </style>
    </head>
    <div id="login">
            <h2>LOGIN</h2>
            <?php include('../config/connection.php'); ?>
        <?php
            if(isset($_SESSION['no-login']))
            {
              echo $_SESSION['no-login'];
              unset($_SESSION['no-login']);
            }
            
            if(isset($_SESSION['login']))
            {
              echo $_SESSION['login'];
              unset($_SESSION['login']);
            }
            ?>
           <br></br>
        <form action="" method="POST">
            USER NAME:
            <input type="text" placeholder="USERNAME" name="username"><br></br>

            PASSWORD:
             <input type="password" placeholder="PASSWORD" name="password"><br></br>
            <input type="submit" name="submit" class="button">
        </form>
        </div>
</html>
<?php

   if(isset($_POST['submit']))
   {
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);

    $sql="SELECT * FROM `admin-table` WHERE username='$username' AND passward='$password'";
    $res=mysqli_query($conn,$sql);
    if($res==true)
    {
        $count=mysqli_num_rows($res);
        if($count>0)
        {
            $_SESSION['user']=$username; // to check authorisation that the user is logged in with value or used directly the url
            header("location:".SITEURL."admin/admin.php");
        }
        else
        {
            $_SESSION['login']="<div class='color'>Username and Password does not match</div>";
            header("location:".SITEURL."admin/login.php");
        }
    }
   }
?>