<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper-lite">
        <h1>Add Category</h1>
        <br>
        
        <?php   
            if(isset($_SESSION['add-category']))
            {
                echo $_SESSION['add-category'];
                unset($_SESSION['add-category']); 
            }
            if(isset($_SESSION['upload-image']))
            {
                echo $_SESSION['upload-image'];
                unset($_SESSION['upload-image']); 
            }
        ?>        

        <br>

<!-- Add Category starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-40 my-table">
                <tr>
                    <td>Title :</td>
                    <td><input type="text" name="title" placeholder="Category title"></td>
                </tr>
                <tr>
                    <td>Select Image :</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio" name="featured" value="yes">yes
                        <input type="radio" name="featured" value="no">No
                    </td>
                </tr>
                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" name="active" value="yes">yes
                        <input type="radio" name="active" value="no">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
<!-- Add Category ends -->

<?php 

    if(isset($_POST['submit']))
    {
        $title = $_POST['title'];
        
        //for radio input, we need to check whether the button is selected or not.
         //echo $featured = $_POST['featured'];
         if(isset($_POST['featured']))
         {
            $featured = $_POST['featured'];
         }
         else
         {
            $featured = "no";
         }

         // for active:
         if(isset($_POST['active']))
         {
            echo $active = $_POST['active'];
         }
         else
         {
            $active = "no";
         }

         //Check whether the image is selected or not and set the value for image name accordingly,
          //print_r($_FILES['image']);

          //die(); // break the code here.

         if(isset($_FILES['image']['name']))
         {
            //upload the image
            //To upload image we need image name,source path and destination path
            $image_name = $_FILES['image']['name'];

            //upload the image only if image is selected
            if($image_name != "")
            {
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
             }
                //later,auto rename our image
                //get the extension of our image (jpg, png, git, etc) e.g. "special.food1.jpg,  specialfood1.jpg"                
         }
         else
         {
            //don't upload image and set the image_name value as blank. 
            $image_name = "";
         }
         
    $sql = "INSERT INTO tbl_category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'                              
    "; 

    $res = mysqli_query($conn,$sql);

    if($res==true)
    {
        //echo "Updated Successfully!";
        $_SESSION['add-category'] = "<div class='success text-center'>Added Category Successfully :)</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    } 
    else 
    {
        //echo "sorry!";
        $_SESSION['add-category'] = "<div class='failure text-center'>Failed To Add Category :(</div>";
        header('location:'.SITEURL.'admin/add-category.php');
    }

    
    }

?>

    </div>
</div>

<?php include('partials/footer.php') ?>


<!-- Note: 
    print_r($_FILES[]);

    echo won't print array,
    so print_r prints array.

    $_FILES[] -----))) prints array


   since it is >>>  type="file"  >>>  use, $_FILES[]

            if(isset($_Files['image']['name']))
            only if >>> 
            input type file, whose file name is image....['image']
            and has image name ['name']
            both name shd be SET...


output of  >>>
print_r($_FILES['image']);
die();
is >>>>
            yesArray ( 
                [name] => f1.jpg 
                [full_path] => f1.jpg 
                [type] => image/jpeg 
                [tmp_name] => G:\xampp\tmp\php29F1.tmp              >>> path of file.
                [error] => 0 
                [size] => 89565 
            )


-->
