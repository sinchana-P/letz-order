<?php include('config/constants.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMBA Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="">
        <div class="menu">
            <div class="logo">
                <a href="<?php SITEURL ?>index.php" title="Logo">
                    <img src="images/logo32.png" alt="Restaurant Logo">
                </a>
            </div>

            <div class="menu-items text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL ; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL ;?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL ;?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL ;?>reviews.php">Reviews</a>
                    </li>
                </ul>
            </div>

        </div>
    </section>

    <!-- Navbar Section Ends Here -->