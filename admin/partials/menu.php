<?php 
    include('../config/constants.php'); 
    include('login-check.php'); 
?>

<html>
    <head>
        <title>Food order Website - Home page</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/admin.css">
        
    </head>
    <body>
        <!-- Menu section starts -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li> <a href="index.php">HOME </a> </li>
                    <li> <a href="manage-admin.php">ADMIN  </a> </li>
                    <li> <a href="manage-category.php">CATEGORY </a> </li>
                    <li> <a href="manage-food.php">FOOD </a> </li>
                    <li> <a href="manage-order.php">ORDER </a> </li>
                    <li> <a href="logout.php">LOGOUT </a> </li>
                </ul>

            </div>
        </div>
       
        <!-- Menu section ends -->