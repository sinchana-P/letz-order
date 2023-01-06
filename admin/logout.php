<?php 
    include('../config/constants.php');

    // This is just based on session.So,
    // 1. Destroy the Session.
    // 1. This also unsets $_session['user]
    session_destroy();   //this will destroy all the sessions we have created in our all pages.

    // 2. Redirect to login page.
    header('location:'.SITEURL.'admin/login.php');

?>