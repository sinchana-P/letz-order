<?php include('partials-front/menu.php') ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL ;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container food-container">
            <h2 class="text-center">Food Menu</h2>

            
            <?php
                    $sql2 = "SELECT * FROM tbl_food WHERE active='yes'";
                    $res2 = mysqli_query($conn,$sql2);
                    if($res2==true){
                        // echo "Data fetched.";
                        $count = mysqli_num_rows($res2);
                        if($count > 0){
                            while($rows = mysqli_fetch_assoc($res2)){
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $description = $rows['description'];
                                $price = $rows['price'];
                                $image_name = $rows['image_name'];
                                ?>
                                <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <?php
                                            if($image_name != ""){
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve" width="50px" height="140px">
                                                <?php
                                            }
                                            else{
                                                echo "<div class='failure text-center text-position'>Image not found.</div>";
                                            }
                                        ?>
                                    </div>
                                    <div class="food-menu-desc">
                                        <h4><?php echo $title; ?></h4>
                                        <p class="food-price"><?php echo $price; ?></p>
                                        <p class="food-detail">
                                            <?php echo $description ; ?>
                                        </p>

                                        <a href="<?php echo SITEURL ;?>order.php?food_id=<?php echo $id ;?>" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>
                                <?php


                            }
                        }    

                    }
                    else{
                        echo "<div class='failure text-center text-middle'>No Data Found.</div>";
                    }

                ?>
                
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php') ?>
