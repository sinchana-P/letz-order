<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper-lite">
        <h1>Change Password</h1>
        <br>

        <?php 
            $id = $_GET['id'];
            //echo $id;
        ?>

        <form action="" method="POST" >
            <table class="tbl-30 my-table">
                <tr>
                    <td>Current Password :</td>
                    <td><input type="password" name="current_password" placeholder="Current password"></td>
                </tr>
                <tr>
                    <td>New Password :</td>
                    <td><input type="password" name="new_password" placeholder="New password"></td>
                </tr>
                <tr>
                    <td>Confirm Password :</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" >
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php 
    if(isset($_POST['submit']))
    {
        //1. get the data from the form.
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']); 

        //2. check the user with current ID and current password exists or not.
        // 2. this is also known as validation of user.
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password' ";  //here id is integer type and pw is string so write within ''.
        //execute the query.
        $res = mysqli_query($conn,$sql);

        if($res==true)
        {
            //check whether data is available or not 
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //user exists and password can be changed.
                //echo "User found";

                //check whether new password and confirm password match or not.
                if($new_password == $confirm_password){
                    $sql2 = "UPDATE tbl_admin SET 
                        password = '$new_password'
                        WHERE id=$id 
                    "; 

                    $res = mysqli_query($conn,$sql2);
                    if($res == true)
                    {
                        $_SESSION['password-update'] = "<div class='success text-center'>Password updated successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        $_SESSION['password-update'] = "<div class='failure text-center'>Failed to change password.</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php'); 
                    }
                }
                else
                {
                    $_SESSION['pwd-not-match'] = "<div class='failure text-center'>Password did not match.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');

                }
            }
            else
            {
                //user doesn't exists,set message and redirect
                $_SESSION['user-not-found'] = "<div class='failure text-center'>User not found.</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

        //3. check whether new password and confirm password match or not.

        //4. change password if all above is true.
    }
?>

<?php include('partials/footer.php'); ?>