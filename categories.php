<?php include('partials-front/menu.php') ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container food-container">
            <h2 class="text-center">Explore Categories</h2>

            <?php 
                
                $sql = "SELECT * FROM tbl_category WHERE active='yes'"; 
                $res = mysqli_query($conn,$sql);
                if($res==true){
                    $count = mysqli_num_rows($res);
                    if($count>0){
                        //categories available
                        //echo "categories available";
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            $id = $rows['id'];
                            $image_name = $rows['image_name'];
                            $title = $rows['title'];

                            ?>
                            <a href="<?php echo SITEURL ;?>category-foods.php?category_id=<?php echo $id ?>&category_name=<?php echo $title ;?>">
                                <div class="box-3 float-container">
                                    <?php
                                        if($image_name != ""){
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ; ?>" alt="Pizza" class="img-responsive img-curve" width="100px" height="300px">
                                            <?php
                                        }
                                        else{
                                            echo "<div class='failure text-center'>Image not available.</div>";
                                        }

                                    ?>

                                    <h3 class="float-text text-white"><?php echo $title ; ?></h3>
                                </div>
                            </a>
                            <?php

                        }

                    }                    
                    else{
                        //categories not available.
                        echo "<div class='error text-center'>Category not found.</div>";
                    }
                }

            ?>





         



            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- social Section Starts Here -->

    <!-- social Section Ends Here -->

<?php include('partials-front/footer.php') ?>
