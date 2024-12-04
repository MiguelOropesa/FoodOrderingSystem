<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php 
            // 1. Get the ID of Selected Admin
            $id=$_GET['id'];

            // 2. Create an SQL Query to Get the Details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Execute the Query
            $res=mysqli_query($conn,$sql);

            //Check whether the Query is Executed or Not
            if($res==true)
            {
                // Check whether the Data is Available or Not
                $count = mysqli_num_rows($res);
                // Check whether we have Admin Data or Not
                if($count==1)
                {
                    // Get the Details
                    //echo"Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name =$row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //Redirect to Manage Admin Page 
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full Name: </td>
                <td>
                    <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                </td>
            </tr>

            <tr>
                <td>Username: </td>
                <td>
                    <input type="text" name="username" value="<?php echo $username; ?>">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                </td>
            </tr>
        </table>

        </form>
    </div>
</div>

<?php 

    //Check whether the Submit Button is Clicked or Not
    if(isset($_POST['submit']))
    {
        //echo"Button Clicked"; 
        // Get All the Variables from Form to Update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Create an SQL Query to Update Admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id = '$id'
        ";

        //Exclude the Query
        $res = mysqli_query($conn,$sql);

        //Check whether the Query Executed Successfully or Not
        if($res==true)
        {
            //Query Executed and Admin Updated
            $_SESSION['update'] =  "<div class='success'> Admin Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to Update Admin
            $_SESSION['update'] =  "<div class='error'> Failed to Delete.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>


<?php include('partials/footer.php'); ?>