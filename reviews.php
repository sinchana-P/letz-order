<?php include('partials-front/menu.php') ?>

<section class="wrapper-review">
        <div class="container">
            <h1 class="title-cat text-center">Customer's Review</h1>
            

            <?php
                $sql = "SELECT * FROM tbl_review";
                $res = mysqli_query($conn,$sql);

                if($res){
                    $count = mysqli_num_rows($res);
                    if($count > 0){
                        while($rows = mysqli_fetch_assoc($res)){
                            $id = $rows['id'];
                            $name = $rows['name'];
                            $email = $rows['email'];
                            $review = $rows['review'];

                            ?>
                            <div class="review-menu-box">
                                    <div class="review-menu-desc">
                                        <h4 class="cust-name"><?php echo $name; ?></h4>
                                        <p class="review-email"><?php echo $email; ?></p>
                                        <p class="review-detail">
                                            <?php echo $review ; ?>
                                        </p>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                }
            ?>
        </div>

        <form action="" method="POST">
                <table>
                    <a href="add-review.php"><input type="button" value="Add Review" name="add-review" class="rev-btn"></a>
                </table>
        </form>
        
        <div class="clearfix"></div>

</section>      
 

<?php include('partials-front/footer.php') ?>