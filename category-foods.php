<?php include('partials-front/menu.php') ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
                if(isset($_GET['category_id']) AND (isset($_GET['category_name']))){
                    // category_id & category_name is set in url
                    $category_id = $_GET['category_id'];
                    $category_name = $_GET['category_name'];
                }
                else{
                    // category_id & category_name is not set in url
                    // redirect to home page.
                    header('location:'.SITEURL);
                }
            ?>
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_name ;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql = "SELECT * FROM tbl_food WHERE category_id='$category_id'";
                $res = mysqli_query($conn,$sql);
                if($res==true){
                    $count = mysqli_num_rows($res);
                    if($count > 0){
                        while($rows=mysqli_fetch_assoc($res)){
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
                                                    <img src="<?php echo SITEURL ;?>images/food/<?php echo $image_name ;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                                <?php
                                            }
                                            else{
                                                echo "<div class='failure text-center text-position'>Image Not Available.</div>";
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
                        echo "<div class='failure text-center text-middle'>No Foods Available On Selected Category.</div>";
                    }
                }
            ?>





            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>
