<?php ob_start() ; ?>
<?php include('partials/menu.php'); ?>
        <div class="main-content">
            <div class="wrapper">
                <h1>Update Food</h1>
                <br><br>               
                <?php 
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM tbl_food WHERE id=$id ";
                    $res = mysqli_query($conn,$sql);

                    if($res==true)
                    {
                        $count = mysqli_num_rows($res);
                        
                        if($count == 1)
                        {
                            $row = mysqli_fetch_assoc($res);

                            $id = $row['id'];
                            $title = $row['title'];
                            $description = $row['description'];
                            $price = $row['price'];
                            $current_image = $row['image_name'];
                            $current_category = $row['category_id'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                        }
                    }
                }    
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-50 my-table">
                        <tr>
                            <td>Title :</td>
                            <td>
                                <input type="text" name="title" value="<?php echo $title ;?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Description :</td>
                            <td>
                                <textarea name="description" id="" cols="23" rows="3"> <?php echo $description ;?> </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Price :</td>
                            <td>
                                <input type="number" name="price" value="<?php echo $price ;?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Current Image :</td>
                            <td>
                                <?php 
                                    if($current_image != "")
                                    {
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image ;?>" width="100px">
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
                            <td>Select Image :</td>
                            <td>
                                <input type="file" name="image">
                            </td>
                        </tr>
                        <tr>
                            <td>Category :</td>
                            <td>
                                <select name="category" value=" <?php echo $category ;?> ">
                                    <?php 
                                        //Create php code to display categories from Database
                                        //1. create SQL to get all active categories from database
                                        $sql2 = " SELECT * FROM tbl_category where active='yes' ";

                                        //Execute the query                                        
                                        $res2 = mysqli_query($conn,$sql2);

                                        if($res2==true)
                                        {
                                            $count = mysqli_num_rows($res2);
                                            //if count is greater than zero,we have categories,else we don't have category.
                                            if($count>0)
                                            {
                                                //we have categories 
                                                while($row=mysqli_fetch_assoc($res2))
                                                {
                                                    //get the details of categories.
                                                    $category_id = $row['id'];
                                                    $category_title = $row['title'];                                                    
                                                    ?>
                                                        <option <?php if($current_category == $category_id){echo "selected" ;} ?> value="<?php echo $category_id ?>"> <?php echo $category_title; ?> </option>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                //we don't have categories
                                                ?>
                                                    <option value="0">No Category Found.</option>
                                                <?php
                                            }
                                        } //2. Display on dropdown  
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Featured :</td>
                            <td>
                                <input <?php if($featured == "yes") {echo "checked" ;} ?> type="radio" name="featured" value="yes">Yes
                                <input <?php if($featured == "no") {echo "checked" ;} ?> type="radio" name="featured" value="no">No
                            </td>
                        </tr>
                        <tr>
                            <td>Active :</td>
                            <td>
                                <input <?php if($active == "yes") {echo "checked" ;} ?> type="radio" name="active" value="yes">Yes
                                <input <?php if($active == "no") {echo "checked" ;} ?> type="radio" name="active" value="no">No
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <!-- use hidden inputs, to send id and old-image-name to delete -->
                                <input type="hidden" name="id" value="<?php echo $id ; ?>">
                                <input type="hidden" name="current_image" value="<?php echo $current_image ;?>">

                                <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                            </td>
                        </tr>
                    </table>
                </form>
                <!-- after submitting form start php -->            
                <?php 
                //1. get all the details from the form
                //2. upload the image if selected 
                //3. remove the image if new image is uploaded and current image exists
                //4. update the food in database
                // Redirect to manage food with session message
                    
                    if(isset($_POST['submit']))
                    { 
                        $id = $_POST['id'];
                        $title = $_POST['title'];
                        $description = $_POST['description'];
                        $price = $_POST['price'];
                        $current_image = $_POST['current_image'];
                        $category = $_POST['category'];
                        $featured = $_POST['featured'];
                        $active = $_POST['active'];
                        // $image_name ???

                        //2. upload the image if selected 
                        //check whether the upload button is clicked or not
                        if(isset($_FILES['image']['name']))
                        {
                            // upload button is clicked
                            $image_name = $_FILES['image']['name'];

                            //check whether the file available or not
                            if($image_name != "")
                            {
                                //A. uploading new image
                                $ext = end(explode('.',$image_name));
                                $image_name = "Food_Name-".rand(0000,9999).'.'.$ext;

                                $source_path = $_FILES['image']['tmp_name'];
                                $destination_path = "../images/food/".$image_name ;

                                $upload = move_uploaded_file($source_path,$destination_path);

                                if($upload == false)
                                {
                                    $_SESSION['upload-food-image'] = "<div class='failure text-center'>Failed To Upload Image.</div>";
                                    header('location:'.SITEURL.'admin/add-food.php');
                                    ob_end_flush();
                                    die();  //stop,coz no need to upload data to the database.
                                }
   
                                //B. Remove current image if available.
                                if($current_image != "")
                                {
                                    $remove_path = "../images/food/".$current_image;
                                    $remove = unlink($remove_path);
                                    
                                    if($remove==false)
                                    {
                                        //failed to remove image
                                        $_SESSION['failed-remove-food'] = "<div class='failure text-center'>Failed To Remove Current Image.</div>";
                                        header('location:'.SITEURL.'admin/manage-food.php');
                                        ob_end_flush();
                                        die();
                                    }
                                }
                            }
                            else
                            {
                                // Default image when image is not selected.
                                $image_name = $current_image;  //this is again bcz... user may open select files tab...and leave with CANCEL without selecting any data.
                            }
                        }
                        else
                        {
                            // keep same old-image
                            $image_name = $current_image;  // Default image when button is not clicked.
                        }

                        $sql3 = "UPDATE tbl_food SET 
                            title = '$title',
                            description = '$description',
                            price = '$price',
                            image_name = '$image_name',
                            category_id = '$category',
                            featured = '$featured',
                            active = '$active'
                            WHERE id=$id                    
                        "; 
                        
                        $res3 = mysqli_query($conn,$sql3);

                        if($res3==true)
                        {
                            $_SESSION['update-food'] = "<div class='success text-center'>Food updated Successfully.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');                        
                            die();
                        }
                        else
                        {
                            $_SESSION['update-food'] = "<div class='failure text-center'>Sorry, Failed To Update food.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die();
                        }
                    }
                ?>
            </div>
        </div>

<?php include('partials/footer.php'); ?>


<!-- NOTE :
use, selected for drop down (option tag, under select tag)
use, checked for radio button.
-->
