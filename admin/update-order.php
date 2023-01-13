<?php 
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-left title-text">Update Order</h1>
        <br><br>

        <?php
            // check whether the id is set or not
            if(isset($_GET['id'])){
                // get the order details
                $id = $_GET['id'];

                // get all other details based on this id
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                if($count==1){
                    //details available
                    $row = mysqli_fetch_assoc($res);
                    $status = $row['status'];
                }
                else{
                    //details not available
                    //redirect to manage order
                    header('location:'.SITEURL.'admin/manage-order.php');
                }

            }
            else{
                // redirect to manage-order page
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><input type="text" name="food"></td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered") {echo "selected" ;} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery") {echo "selected" ;} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered") {echo "selected" ;} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled") {echo "selected" ;} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit'])){
                $status = $_POST['status'];

                $sql2 = "UPDATE tbl_order SET 
                    status = '$status'
                    WHERE id=$id
                "; 
                $res2 = mysqli_query($conn,$sql2);
                if($res2){
                    //echo "updated!";
                    $_SESSION['update-order'] = "<div class='success text-center'>Food updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');                        
                    die();
                } 
                else{
                    //echo "failed to update order";
                    $_SESSION['update-order'] = "<div class='failure text-center'>Sorry, Failed To Update food.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                    die();
                }
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php') ?>

