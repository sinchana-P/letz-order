<?php include('partials/menu.php'); ?>
        <!-- Main content section starts -->
        <div class="main-content">
            <div class="wrapper">
               <h1 class="text-left"> Manage Food </h1>
               <br />
               <br />

               <!-- Button to add Admin -->
               <a href="<?php echo SITEURL ; ?>admin/add-food.php" class="btn-primary">Add Food</a>

               <?php
                    if(isset($_SESSION['add-food']))
                    {
                        echo $_SESSION['add-food'];
                        unset($_SESSION['add-food']);
                    }
                    if(isset($_SESSION['delete-food']))
                    {
                        echo $_SESSION['delete-food'];
                        unset($_SESSION['delete-food']);
                    }
                    if(isset($_SESSION['remove-image']))
                    {
                        echo $_SESSION['remove-image'];
                        unset($_SESSION['remove-image']);
                    }
                    if(isset($_SESSION['failed-remove-food']))
                    {
                        echo $_SESSION['failed-remove-food'];
                        unset($_SESSION['failed-remove-food']);
                    }
                    if(isset($_SESSION['update-food']))
                    {
                        echo $_SESSION['update-food'];
                        unset($_SESSION['update-food']);
                    }
                    

               ?>

               <br />
               <br />

               <table class="tbl-full">
                    <tr>
                       <th>Sl.NO</th>
                       <th>Title</th>
                       <th>Price</th>
                       <th>Image</th>
                       <th>Featured</th>
                       <th>Active</th>
                       <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_food";

                        $res = mysqli_query($conn,$sql);

                        if($res==true)
                        {
                            $count = mysqli_num_rows($res);
                            $sn = 1;

                            if($count>0)
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $id = $row['id'];
                                    $title=$row['title'];
                                    $price=$row['price'];
                                    $image_name=$row['image_name'];
                                    $featured=$row['featured'];
                                    $active=$row['active'];

                                    ?>
                                        <tr>
                                            <td><?php echo $sn++ ;?></td>
                                            <td><?php echo $title;?></td>
                                            <td><?php echo $price ;?></td>
                                            <td>
                                                <?php
                                                    if($image_name != "")
                                                    {
                                                        ?>
                                                            <img src="../images/food/<?php echo $image_name ; ?>" width ="100px">
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        echo "<div class='failure'>Image Not Added.</div>";
                                                    } 

                                                ?>
                                            </td>
                                            <td><?php echo $featured ;?></td>
                                            <td><?php echo $active;?></td>
                                            <td>
                                                <!-- <a href="#" class="btn-secondary">Update Food</a> -->
                                                <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id ;?>" class="btn-secondary">Update Food</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id ;?>&image_name=<?php echo $image_name ;?>" class="btn-danger">Delete Food </a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                // HTML inside PHP.....
                                echo "<tr> <td colspan='7' class='error'>Food Not Added.</td> </tr>";  
                            }
                        }
                    
                    ?>
               </table>


                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main content section ends -->

<?php include('partials/footer.php')?>