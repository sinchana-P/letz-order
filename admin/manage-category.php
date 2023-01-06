<?php include('partials/menu.php'); ?>


        <!-- Main content section starts -->
        <div class="main-content">
            <div class="wrapper">
               <h1 class="text-left "> Manage Category </h1>             
               <br />
               <br />

               <!-- Button to add Admin -->
               <a href="add-category.php" class="btn-primary">Add Category</a>

               <br />
               
                <?php   
                    if(isset($_SESSION['add-category']))
                    {
                        echo $_SESSION['add-category'];
                        unset($_SESSION['add-category']); 
                    }
                    if(isset($_SESSION['update-category']))
                    {
                        echo $_SESSION['update-category'];
                        unset($_SESSION['update-category']); 
                    }
                    if(isset($_SESSION['remove-category']))
                    {
                        echo $_SESSION['remove-category'];
                        unset($_SESSION['remove-category']); 
                    }
                    if(isset($_SESSION['remove-image']))
                    {
                        echo $_SESSION['remove-image'];
                        unset($_SESSION['remove-image']); 
                    }
                    if(isset($_SESSION['no-category-found']))
                    {
                        echo $_SESSION['no-category-found'];
                        unset($_SESSION['no-category-found']); 
                    }
                    if(isset($_SESSION['update-category']))
                    {
                        echo $_SESSION['update-category'];
                        unset($_SESSION['update-category']); 
                    }
                    if(isset($_SESSION['failed-remove']))
                    {
                        echo $_SESSION['failed-remove'];
                        unset($_SESSION['failed-remove']); 
                    }
                    
                    

                ?>
                <br />

                <table class="tbl-full">
                    <tr>
                       <th>Sl.NO</th>
                       <th>Title</th>
                       <th>Image</th>
                       <th>Featured</th>
                       <th>Active</th>
                       <th>Actions</th>
                    </tr>

                    <?php  
                        
                        $sql = "SELECT * FROM tbl_category";
                        $res = mysqli_query($conn,$sql);

                        if($res==true)
                        {
                            // we have data in database
                            $count = mysqli_num_rows($res);
                            $sn = 1; 
                            if($count > 0)
                            {
                                while($rows = mysqli_fetch_assoc($res)) 
                                {
                                    $id = $rows['id'];
                                    $title = $rows['title'];
                                    $image_name = $rows['image_name'];
                                    $featured = $rows['featured'];
                                    $active = $rows['active'];

                                    ?>

                                    <tr>
                                        <td><?php echo $sn++ ?>.</td>
                                        <td><?php echo $title ?></td>

                                        <td>
                                            <?php 
                                                //check whether image name is available or not
                                                if($image_name!="")
                                                {
                                                    //Display the image.
                                                    //break php tag     //add HTML tag
                                                    ?>
                                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ;?>" width="100px" >
                                                    <?php
                                                }
                                                else
                                                {
                                                    //Display the message.
                                                    echo "<div class='failure'>Image Not Added.</div>";
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo $featured ?></td>
                                        <td><?php echo $active ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                        </td>
                                    </tr>                                    
                                    
                                    <?php

                                }
                            }
                            else
                            {
                                //we don't have data in database.
                                //we'll display message inside table, so break php....to write HTML
                                ?>
                                <tr>
                                    <td colspan="6"><div class="failure text-center">Sorry, No Categories Added.</div></td>
                                </tr>

                                <?php
                            }
                            
                       

                        }
                       
                    ?>



               </table>


                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main content section ends -->

<?php include('partials/footer.php')?>
