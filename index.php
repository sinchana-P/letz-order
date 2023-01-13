<?php include('partials-front/menu.php') ?>

    <!-- FOOD SEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
        <!-- sending search key word by POST method -->
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST"> 
                <!-- name="search" -->
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- FOOD SEARCH Section Ends Here -->
    <?php
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']); 
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                $sql = "SELECT * FROM tbl_category WHERE active='yes' AND featured='yes' LIMIT 3";
                $res = mysqli_query($conn,$sql);
                
                if($res == true)
                {
                    $count = mysqli_num_rows($res);

                    if($count > 0)
                    {
                        while($row = mysqli_fetch_assoc($res))
                        {
                            $id = $row['id']; 
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            ?>
                                <a href="<?php SITEURL ;?>category-foods.php?category_id=<?php echo $id ;?>&category_name=<?php echo $title ;?>">
                                    <div class="box-3 float-container">
                                        <?php
                                            if($image_name != ""){
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ; ?>" alt="Pizza" class="img-responsive img-curve" width="100px" height="300px">
                                                <?php
                                            }
                                            else{
                                                echo "<div class='failure text-center text-position'>Image not available.</div>";
                                            }

                                        ?>

                                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                    </div>
                                </a>
                            <?php

                        }

                    }
                }
                                                                                                                                                                
            ?>





            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container food-container">
            <h2 class="text-center">Food Menu</h2>



                <?php
                    $sql2 = "SELECT * FROM tbl_food WHERE active='yes' AND featured='yes' LIMIT 6";
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
                                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve" width="50px" height="100px">
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

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->

    <!-- social Section Ends Here -->

<?php include('partials-front/footer.php') ?>

