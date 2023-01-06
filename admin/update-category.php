<?php include('partials/menu.php'); ?>

<?php
    //check whether the id is set or not
    if(isset($_GET['id']))
    {
        //get the id and all other details
        $id = $_GET['id'];
    
        $sql = "SELECT * FROM tbl_category WHERE id=$id";
        $res = mysqli_query($conn,$sql);

        if($res==true)
        {
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                $row = mysqli_fetch_assoc($res);

                $id = $row['id'];
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else
            {
                //redirect to manage-category with session message
                $_SESSION['no-category-found']="<div class='failure text-center'>Category Not Found.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
    }
    else
    {
        //redirect to manage category
        header('location:'.SITEURL.'admin/manage-category.php');
    }


?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-50 my-table">
                <tr>
                    <td>Title :</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image :</td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                //display the image
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px">
                                <?php
                            }
                            else
                            {
                                echo "<div class='failure'>No Image Selected.</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image :</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>
                <tr>
                    <td>Featured : </td>
                    <td>
                        <input <?php if($featured=="yes"){echo "checked" ;} ?> type="radio" name="featured" value="yes">Yes
                        <input <?php if($featured=="no"){echo "checked" ;} ?> type="radio" name="featured" value="no">No
                    </td>
                </tr>
                <tr>
                    <td>Active : </td>
                    <td>
                        <input <?php if($active=="yes"){echo "checked" ;} ?> type="radio" name="active" value="yes" >Yes
                        <input <?php if($active=="no"){echo "checked" ;} ?> type="radio" name="active" value="no" >No
                    </td>
                </tr> 
                <tr colspan="2">
                    <td>
                        <!-- to get id of selected category (item)... -->
                        <input type="hidden" name="id" value="<?php echo $id ; ?>"> 
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary"> 
                    </td>
                </tr>               
            </table>
        </form>


        <!-- after submitting form start php -->
        <?php  
            if(isset($_POST['submit']))
            {
                //1. get all the values from our form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                //$image_name ...????


                //2. updating the new image,if selected
                //checking whether image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    // get the image details
                    $image_name = $_FILES['image']['name'];
                    
                    //check whether the image is available or not
                    if($image_name != "")
                    {
                        //image available

                        //A. UPLOAD THE NEW IMAGE...

                        //copied same code from add-category.php

                        //Auto rename our image
                        //get the extension of our image (jpg, png, git, etc) e.g. "special.food1.jpg,  specialfood1.jpg"                

                        $ext = end(explode('.',$image_name));

                        //rename the image-name
                        //Final image name >>>
                        $image_name = "Food_Category_".rand(000,999).'.'.$ext;  //e.g. Food_Category_834.jpg
                        
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;

                        //Finally upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        //check whether image is uploaded or not
                        //and if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //set message
                            $_SESSION['upload-image'] = "<div class='failure text-center'>Failed To Upload Image.</div>";
                            // redirect to add category page
                            header('location:'.SITEURL.'admin/add-category.php');
                            //stop the process
                            die();  //stop,coz no need to upload data to the database.
                        }

                         //B. REMOVE THE CURRENT IMAGE...
                         //check whether the image is removed or not
                         //if failed to remove then display message and stop the process
                         //fix the bug...
                         if($current_image != "")
                         {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);

                            if($remove==false)
                            {
                                //failed to remove image
                                $_SESSION['failed-remove'] = "<div class='failure text-center'>Failed To Remove Current Image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                            }
                         }                       
                    }
                    else
                    {
                        $image_name = $current_image;  //this is again bcz... user may open select files tab...and leave with CANCEL without selecting any data.
                    }
                }
                else
                {
                    // keep same old-image
                    $image_name = $current_image;
                }
 
                
                $sql2 = "UPDATE tbl_category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id                
                "; 
                
                $res = mysqli_query($conn,$sql2);

                if($res==true)
                {
                    $_SESSION['update-category'] = "<div class='success text-center'>Updated Category Successfully :)</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['update-category'] = "<div class='failure text-center'>Sorry, Failed To Update Category :(</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>


