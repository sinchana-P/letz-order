<?php 

    include('partials/menu.php');

    $id = $_GET['id'];
    //echo $id;

    $sql = "SELECT * FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($res);

    if($count==1)
    {
        $row = mysqli_fetch_assoc($res);
       // echo $row['full_name'];

       $id = $row['id'];
       $full_name = $row['full_name'];
       $username = $row['username'];
       $password = $row['password'];
    }
?>

<div class="main-content">
    <div class=" wrapper-lite">
        <h1>Update Admin</h1>
        <br>
        
        <form action="" method="POST"> 
            <table class="tbl-50 my-table">

                <tr>
                    <td>Full Name : </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name ; ?>" > 
                    </td>
                </tr>
                <tr>
                    <td>Username :</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username ; ?>" >
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 

    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        $sql2 = "UPDATE tbl_admin SET 
            full_name = '$full_name',
            username = '$username'
            WHERE id=$id
        "; 

        $res = mysqli_query($conn,$sql2);

        if($res==true)
        {
            //echo "successfully updated";
            $_SESSION['update-admin'] = "<div class='success text-center'>Admin updated Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>



<?php include('partials/footer.php'); ?>