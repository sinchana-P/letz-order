<?php 

    include('../config/constants.php');

    //check whether the id and image_name value is set or not.   //security added to protect from hackers.
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //get the value and delete
        $id = $_GET['id'];
        //echo $id; 
        $image_name = $_GET['image_name'];

        //1. remove the physical image file if available
        if($image_name != "")
        {
            //image is available, so remove it.
            $path = "../images/category/".$image_name;
            //remove the image.
            $remove = unlink($path);

            //if failed to remove image,then add an error message and stop the process.
            if($remove==false)
            {
                //set the session message
                $_SESSION['remove-image'] = "<div class='failure text-center'>Sorry,Failed To Remove Category Image</div>";
                //redirect to manage category message
                header('location:'.SITEURL.'admin/manage-category');
                //stop the process
                die();
            }
        }

        //2.remove data from database       
        //3. redirect  t0 manage-category page with message

        //remove data from database
        //SQL query to delete data from database.
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        $res = mysqli_query($conn,$sql);    //execute the query

        if($res==true)
        {
            $_SESSION['remove-category'] = "<div class='success text-center'>Successfully Deleted Category :)</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['remove-category'] = "<div class='failure text-center'>Failed To Deleted Category :(</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    }
    else
    {
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    
?>