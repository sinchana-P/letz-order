<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Join Simba Family</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body class="login-body">
        <div class="login text-center">
            <h1 class="login-title">login</h1>
            
            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            
            <br>

            <!-- login starts here -->
            <form action="" method="POST" class="text-center">
                <div class="unit">
                    <label for="username">Username :</label>
                    <input type="text" name="username" placeholder="Enter Username">
                </div>
                <div class="unit">
                    <label for="username">Password  :</label>
                    <input type="password" name="password" placeholder="Enter Username">
                </div>
                
                <input class="submit btn-secondary" type="submit" name="submit" value="login">
            </form>
            <!-- login ends here -->

            <p class="text-center p-tag">Created By <a href="https://www.booking.com/hotel/ae/simba.html">Sinch-Zai</a></p>
        </div>
    </body>
</html>

<?php 

    //Check whether the submit button is clicked or not.
    if(isset($_POST['submit']))
    {
        //process for login.
        //1. Get the data from login.
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,md5($_POST['password']));

        //2. SQL to check whether user with username and password exists or not.
        $sql = "SELECT * FROM tbl_admin where username='$username' AND password='$password'"; 
       
        //3. Execute the query.
        $res = mysqli_query($conn,$sql);

        //4. count the rows to check whether the user exists or not.
        $count = mysqli_num_rows($res);

        if($count ==1)
        {
            //User available & login success.
            $_SESSION['login'] = "<div class='success text-center'>Login successfully.</div>";
            $_SESSION['user'] = $username ;   // To check whether the user is logged in or not & logout will unset it (no other code will unset this session).
            //Redirect to Home page / Dashboard. 
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //User not available & login fail.
            $_SESSION['login'] = "<div class='failure text-center'>Username or Password did not match.</div>";
            //Redirect to same (login) page.
            header('location:'.SITEURL.'admin/login.php');
        }
        
    }

?>