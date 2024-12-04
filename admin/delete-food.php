<?php 
    //Include Constants Page
    include('../config/constants.php'); 
    //echo"Delete Food Page";

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Process to Delete
        //echo "Process to Delete";

        // 1. Get ID and Image Name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // 2. Remove the Image if Available
        // Check whether the Image is Available or Not
        if($image_name != "")
        {
            // It Has Image and Need to Remove From Folder
            // Get the Image Path
            $path = "../images/food/".$image_name;

            // Remove Image File From Folder 
            $remove = unlink($path);

            // Check whether the Image is Removed or Not
            if($remove==false)
            {
                //Failed to Remove Image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                //Redirect to Manage Food
                header('location:'.SITEURL.'admin/manage-food.php');
                //Stop the Process of Deleting Food
                die();
            }
        }

        // 3. Delete Food from Database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the Query Executed or Not and Set the Session Message Respectively
        // 4. Redirect to Manage Food with Session Message
        if($res==true)
        {
            //Food Deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            //Redirect
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //Failed to Delete Food
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            //Redirect
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        
    }
    else
    {
        // Redirect to Manage Food Page
        //echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>