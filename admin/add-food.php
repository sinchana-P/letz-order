<?php ob_start(); ?>
<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['img-upload-failed']))
            {
                echo $_SESSION['img-upload-failed'];
                unset($_SESSION['img-upload-failed']);
            }
            if(isset($_SESSION['upload-food-image']))
            {
                echo $_SESSION['upload-food-image'];
                unset($_SESSION['upload-food-image']);
            }           
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-50 my-table">
                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food...">
                    </td>
                </tr>
                <tr>
                    <td>Description :</td>
                    <td>
                        <textarea name="description" id="" cols="23" rows="3" placeholder="Description of the food..."></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price :</td>
                    <td>
                        <input type="number" name="price">
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
                        <select name="category" id="">

                            <?php 
                                //Create php code to display categories from Database
                                //1. create SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_category where active='yes' ";

                                //Execute the query
                                $res = mysqli_query($conn,$sql);

                                if($res==true)
                                {
                                    $count = mysqli_num_rows($res);

                                    //if count is greater than zero,we have categories,else we don't have category.
                                    if($count>0)
                                    {
                                        //we have categories 
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            //get the details of categories.
                                            $id = $row['id'];
                                            $title = $row['title'];

                                            ?>
                                                <option value="<?php echo $id ?>"> <?php echo $title; ?> </option>
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
                                }
                                //2. Display on dropdown  
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio" name="featured" value="yes">Yes
                        <input type="radio" name="featured" value="no">No
                    </td>
                </tr>
                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" name="active" value="yes">Yes
                        <input type="radio" name="active" value="no">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


        <!-- after form tag ends... -->
        <?php 
            //check whether the button is clicked or not...
            if(isset($_POST['submit']))
            {
                //Add the food to database
                //echo "clicked!";

                //1. get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //check whether radio button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //2. Upload the image if selected 
                // Check whether the select image is selected or not & upload the image,only if the image selected
                if(isset($_FILES['image']['name']))
                {
                    //get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    //check whether the image is selected or not and upload image only if selected
                    if($image_name != "")
                    {
                        //image is selected
                        //A. Rename the image
                        // get the extension of selected image (jpg, png, gif, etc...)  "sony-p-doll.jpg"  >>> sony-p-doll jpg
                        $ext = end(explode('.', $image_name));

                        // Create New Name For Image
                        $image_name = "Food_Name-".rand(0000,9999).".".$ext;    // new image name e.g. "Food-Name-657.jpg"

                        //B. Upload the image
                        //Get the Src Path and Destination Path

                        //Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //Destination Path for the image to be uploaded
                        $dst = "../images/food/".$image_name;

                        //Finally upload the food image
                        $upload = move_uploaded_file($src,$dst);

                        //check whether image uploaded or not
                        if($upload==false)
                        {
                            //failed to upload the image
                            //Redirect to add food page with error message
                            $_SESSION['img-upload-failed'] = "<div class='failure text-center'>Failed to Upload Image</div>"; 
                            header('location:'.SITEURL.'admin/add-food.php');
                            ob_end_flush();
                            //stop the process
                            die();
                        }
                    } 
                }
                else
                {
                    $image_name = "";   //setting the default value as blank
                }
                //

                //3. Insert into database

                //Create a SQL Query to save or Add food
                // for numerical we do not need to pass value inside quotes '' but for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'              
                "; 

                //Execute the query
                $res2 = mysqli_query($conn,$sql2);

                //check whether data inserted or not
                //4. Redirect with message to manage-food page
                if($res2 == true)
                {
                    // data inserted successfully
                    $_SESSION['add-food'] = "<div class='success text-center'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //failed to insert data.
                    $_SESSION['add-food'] = "<div class='failure text-center'>Failed To Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>