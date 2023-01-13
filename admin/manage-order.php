<?php include('partials/menu.php'); ?>


        <!-- Main content section starts -->
        <div class="main-content">
            <div class="wrapper-lite2">
               <h1 class="text-left title-text"> Manage Order </h1>
               <table class="tbl-full">
                <br />
                <br />
       
                <?php
                    if(isset($_SESSION['update-order'])){
                        echo $_SESSION['update-order'];
                        unset($_SESSION['update-order']);
                    }
                ?>
                
                <br>
                    <tr>
                       <th>Sl.No</th>
                       <th>Food</th>
                       <th>Price</th>
                       <th>Qty</th>
                       <th>Total</th>
                       <th>Order Date</th>
                       <th>Status</th>
                       <th>Customer Name</th>
                       <th>Contact</th>
                       <th>Email</th>
                       <th>Address</th>
                       <th>Actions</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                        $res = mysqli_query($conn,$sql);
                        if($res==true){
                            $count = mysqli_num_rows($res);
                            if($count > 0){
                                $sn=1;
                                while($rows = mysqli_fetch_assoc($res)){
                                    $id = $rows['id'];
                                    $food = $rows['food'];
                                    $price = $rows['price'];
                                    $qty = $rows['qty'];
                                    $total = $rows['total'];
                                    $order_date = $rows['order_date'];
                                    $status = $rows['status'];
                                    $customer_name = $rows['customer_name'];
                                    $customer_contact = $rows['customer_contact'];
                                    $customer_email = $rows['customer_email'];
                                    $customer_address = $rows['customer_address'];

                                    ?>
                                        <tr>
                                            <td> <?php echo $sn++ ; ?>. </td>
                                            <td> <?php echo $food ; ?> </td>
                                            <td> <?php echo $price ; ?> </td>
                                            <td> <?php echo $qty ; ?> </td>
                                            <td> <?php echo $total ; ?> </td>
                                            <td> <?php echo $order_date ; ?> </td>
                                            <td> 
                                                    <!-- to display status in different colors. -->
                                                    <?php
                                                    // Ordered,On Delivery,Delivered,Cancelled.
                                                        if($status=="Ordered"){
                                                            echo "<label>$status</label>";
                                                        }
                                                        elseif($status=="On Delivery"){
                                                            echo "<label style='color: orange ;'>$status</label>";
                                                        }
                                                        elseif($status=="Delivered"){
                                                            echo "<label style='color: green ;'>$status</label>";
                                                        }
                                                        elseif($status=="Cancelled"){
                                                            echo "<label style='color: red ;'>$status</label>";
                                                        }
                                                    ?>
                                            </td>
                                            <td> <?php echo $customer_name ; ?> </td>
                                            <td> <?php echo $customer_contact ; ?> </td>
                                            <td> <?php echo $customer_email ; ?> </td>
                                            <td> <?php echo $customer_address ; ?> </td>
                                            <td>
                                                <a href="<?php echo SITEURL ;?>admin/update-order.php?id=<?php echo $id ;?>" class="btn-secondary">UpdateOrder</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }
                            else{
                                echo "<div class='failure text-center'>Orders Not Available.</div>";
                            }
                        }
                       
                    ?>
                    
                   
               </table>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main content section ends -->

<?php include('partials/footer.php')?>