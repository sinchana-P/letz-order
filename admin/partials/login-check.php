<?php 

    //Authorization - access control
    //Check whether the user is logged in or not.
    if(!isset($_SESSION['user']))  //if user session is not set.
    {
        //User is not logged in.
        //Redirect to login page with message.
        $_SESSION['no-login-message'] = "<div class='failure text-center'>Please login to access Admin Panel.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }

?>

