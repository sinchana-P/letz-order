<?php

    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        echo $id = $_GET['id'];
        echo $image_name = $_GET['image_name'];

        if($image_name != "")
        {
            $path = "../images/food/".$image_name;
            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['remove-image'] = "<div failure text-center>Failed To Remove Food Image.</div>";
                header('loaction:'.SITEURL.'admin/manage-food.php');
                die();
            }        
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/manage-food.php');
    }



    $sql = "DELETE FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn,$sql);

    if($res==true)
    {
        $_SESSION['delete-food'] = "<div class='success text-center'>Food Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        $_SESSION['delete-food'] = "<div class='failure text-center'>Failed To Delete Food.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

   
?>