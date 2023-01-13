<?php include('partials-front/menu.php') ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <?php
            // get the search keyword 
            // old query.
            // $search = $_POST['search'];

            //new query
            // this converts 
            $search = mysqli_real_escape_string($conn,$_POST['search']);
        ?>
            
            <h2 class="text-color">Foods on Your Search <a href="#" class="text-white"><?php echo $search ;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container food-container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                // SQL query to get foods based on search keyword
                //SECURING THE PHP CODE.
                // bug :  for e.g. $search = burger' ;
                // SELECT * FROM tbl_food WHERE title LIKE '%%' or description LIKE '%%'";
                // SELECT * FROM tbl_food WHERE title LIKE '%burger'%' or description LIKE '%burger'%'";
                // %'   --->  remains extra for sql query
                // hackers can do...
                // for e.g. $search = burger' ; DROP database name;   ---> this delete our complete database.
                // so to protect from hackers
                // use ---> mysqli_real_escape_string() ---> built in method;

                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' or description LIKE '%$search%'";
                $res = mysqli_query($conn,$sql);

                if($res == true){
                    $count = mysqli_num_rows($res);
                    if($count > 0){
                        // Food available.
                        while($rows = mysqli_fetch_assoc($res)){
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $price = $rows['price'];
                            $description = $rows['description'];
                            $image_name = $rows['image_name'];

                            ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if($image_name != ""){
                                            ?>
                                                <img src="<?php SITEURL ;?>images/food/<?php echo $image_name ;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                        else{
                                            echo "<div class='failure text-center text-position'>Image Not Found.</div>";
                                        }
                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title ;?></h4>
                                    <p class="food-price"><?php echo $price ;?></p>
                                    <p class="food-detail">
                                        <?php echo $description ;?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL ;?>order.php?food_id=<?php echo $id ;?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                            <?php
                        }
                        
                    }
                    else{
                        // Food not available.
                        echo "<div class='failure text-center text-middle'>Food not available.</div>";
                    }
                }
        
            ?>





            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


<?php include('partials-front/footer.php') ?>
