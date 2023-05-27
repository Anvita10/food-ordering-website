<?php
 // Checking authorisation
 if(!isset($_SESSION['user']))
 {
    $_SESSION['no-login']="<div class='text-danger'>YOU ARE NOT LOGGED IN</div>";
    header("location:".SITEURL."admin/login.php");
 }
?>