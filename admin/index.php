<?php include('partials/menu.php'); ?>
        

        <!-- Main content section starts -->
        <div class="main-content">
            <div class="wrapper dashboard-wrapper">
               <h1 class="text-left title-text"> DASHBOARD </h1>

                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br>

                <div class="col-4 text-center">
                    <?php
                        $sql = "SELECT * FROM tbl_category";
                        $res = mysqli_query($conn,$sql);
                        if($res){
                            $count = mysqli_num_rows($res);
                        }
                    ?>
                    <h1><?php echo $count ;?></h1>
                    <br />
                    <p class="p-text">Categories</p>
                </div>

                <div class="col-4 text-center">
                    <?php
                        $sql2 = "SELECT * FROM tbl_food";
                        $res2 = mysqli_query($conn,$sql2);
                        if($res2){
                            $count2 = mysqli_num_rows($res2);
                        }
                    ?>
                    <h1><?php echo $count2 ;?></h1>
                    <br />
                    <p class="p-text">Foods available</p>
                </div>

                <div class="col-4 text-center">
                    <?php
                        $sql3 = "SELECT * FROM tbl_order";
                        $res3 = mysqli_query($conn,$sql3);
                        if($res3){
                            $count3 = mysqli_num_rows($res3);
                        }
                    ?>
                    <h1><?php echo $count3 ;?></h1>
                    <br />
                    <p class="p-text">Total Orders</p>
                </div>
                
                <div class="col-4 text-center">
                    <?php
                        //Aggregate function in SQL.
                        // revenue generated only for the food delivered (status)
                        $sql3 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'"; 
                        $res3 = mysqli_query($conn,$sql3);
                        if($res3){
                            $row3 = mysqli_fetch_assoc($res3);
                            $total_revenue = $row3['Total'];     
                        }
                    ?>
                    <h1>$<?php echo $total_revenue ;?></h1>
                    <br />
                    <p class="p-text">Revenue Generated</p>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main content section ends -->


<?php include('partials/footer.php')?>

<!-- 
<?php
                        $sql3 = "SELECT * FROM tbl_order";
                        $res3 = mysqli_query($conn,$sql3);
                        if($res3){
                            $count3 = mysqli_num_rows($res3);
                            if($count > 0){
                                $totalRevenue = 0;
                                while($row = mysqli_fetch_assoc($res3)){
                                    $total = $row['total'];
                                    $totalRevenue += $total;
                                }
                            }
                        }
                    ?> -->