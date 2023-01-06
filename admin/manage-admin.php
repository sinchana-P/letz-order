<!-- <?php
echo "Hello Admin!";
?> -->

<?php include('partials/menu.php'); ?>


        <!-- Main content section starts -->
        <div class="main-content">
            <div class="wrapper admin-wrapper">
               <h1 class="text-left"> Manage Admin </h1>
               <br />

               <?php
                    if(isset($_SESSION['add-admin']))
                    {
                        echo $_SESSION['add-admin'];        //displays Session forever
                        unset($_SESSION['add-admin']);      //so to Remove it next refresh of browser we unset the session
                    }
                    if(isset($_SESSION['delete-admin']))
                    {
                        echo $_SESSION['delete-admin'];        //displays Session forever
                        unset($_SESSION['delete-admin']);      //so to Remove it next refresh of browser we unset the session
                    }
                    if(isset($_SESSION['update-admin']))
                    {
                        echo $_SESSION['update-admin'];
                        unset($_SESSION['update-admin']);
                    }
                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }
                    if(isset($_SESSION['password-update']))
                    {
                        echo $_SESSION['password-update'];
                        unset($_SESSION['password-update']);
                    }
                ?>

                <br />

               <!-- Button to add Admin -->
               <a href="add-admin.php" class="btn-primary">Add Admin</a>

               <br />
               <br />


               <table class="tbl-full">
                    <tr>
                       <th>Sl.NO</th>
                       <th>Full Name</th>
                       <th>Username</th>
                       <th>Actions</th>
                    </tr>

                    <?php 
                        $sql = "SELECT * FROM tbl_admin ";
                        $res = mysqli_query($conn,$sql);

                        if($res==true)
                        {
                            //count rows to check whether we have data in db or not.
                            $count = mysqli_num_rows($res);  //function to get all the rows in the db.
                            $sn = 1;

                            if($count > 0)
                            {
                                //we have data in database.
                                while($rows = mysqli_fetch_assoc($res))
                                {
                                    // using while loop to get all the data from the database.
                                    // and while loop will run as long as we have data in our database.

                                    // get individual data.
                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];
                                    
                                    //break (and add) php-tag to add HTML-tags (here).
                                    ?>
                                    <!-- Display the values in the table. -->
                                    <tr>
                                        <td><?php echo $sn++ ;?>.</td>
                                        <td><?php echo $full_name ; ?></td>
                                        <td><?php echo $username ; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                            <!-- <a href="delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a> -->
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                            else
                            {
                                //we don't have data in our database.
                                echo "Not have any data in database";
                            }
                        }

                    ?>


               
               </table>


                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main content section ends -->

<?php include('partials/footer.php')?>