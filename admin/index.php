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
                    <h1>5</h1>
                    <br />
                    <p class="p-text">Categories</p>
                </div>

                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br />
                    <p class="p-text">Categories</p>
                </div>

                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br />
                    <p class="p-text">Categories</p>
                </div>

                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br />
                    <p class="p-text">Categories</p>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main content section ends -->


<?php include('partials/footer.php')?>