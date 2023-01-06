<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br />
        <br />

        <?php 
            if(isset($_SESSION['add-admin']))       // Checking the session is set or not
            {
                echo $_SESSION['add-admin'];        //Display session if set
                unset($_SESSION['add-admin']);      //Remove session
            }   
        ?>

        <br />
        <br />

        <form action="" method="POST">
           <table class="tbl-30 my-table">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="  Enter your name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="  Your username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="  Enter password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
            </tr>
           </table>



        </form>
    </div>

</div>

<?php include('partials/footer.php'); ?>


<?php  
    //process the value from form and save it in Database.

    //check whether the button is clicked or not.

    if(isset($_POST['submit']))
    {
        // Button clicked.
        // echo "Button clicked";

        //1. Get the data from our form.
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);  //password Encryption with MD5.

        //2. SQL query to save the data into database
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        "; 
        //echo $sql;   


        //3. Executing Query and saving Data into Database.
        //  moved to constants.php file
        // $res = mysqli_query($conn,$sql) or die(mysqli_error());

        $res = mysqli_query($conn,$sql); 
        echo $res;

         //4. Check whether the (Query is executed or not) data is inserted or not and display appropriate message.
         if($res==true){
            //Data inserted
            //echo "Data inserted";   // we use Session variables from now on.  
            //Create a session variable to display message
            $_SESSION['add-admin'] = "<div class='success text-center'> Admin Added Successfully. </div>";
            // Redirect Page to the manage-admin.php
            header('location:'.SITEURL.'admin/manage-admin.php' );
         }
         else {
            //Failed to insert admin to db
            // echo "Failed to insert data";
             //Create a session variable to display message
             $_SESSION['add-admin'] = "<div>Failed to add admin. </div>";
            // Redirect Page to the manage-admin.php
            header('location:'.SITEURL.'admin/add-admin.php' );
         }



    } 

?>

<!-- NOTE : -->

<!-- isset function :
 checks whether a certain property is set or not ? -->

 <!-- here, we are checking ,
 whether the value on submit button,
 is passed through post method or not -->


<!-- SESSION :
IS LIKE A VARIABLE,
BUT IT WORKS ACROSS THE PAGES
IT WILL ONLY HOLD THE VALUE AS LONG AS THE BROWSER IS OPEN  -->


<!-- A session is started with the session_start() function.
Session variables are set with the PHP global variable: $_SESSION.
The session_start() function must be the very first thing in your document. Before any HTML tags. -->
