<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" placeholder="Price of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                                <?php
                                    //Create PHP Code to Display Categories from Database
                                    // 1. Create SQL to Get All Active Categories from Database
                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                    //Executing Query
                                    $res = mysqli_query($conn, $sql);

                                    //Count Rows to Check whether we have Categories or Not
                                    $count = mysqli_num_rows($res);

                                    //If Count is Greater than zero, we have Categories else we do not have Categories
                                    if ($count>0)
                                    {
                                        //We have Categories
                                        while ($row = mysqli_fetch_array($res))
                                        {
                                            //Get the Value of Category
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>

                                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        //We do not have Categories
                                        ?>
                                        <option value="0">No Category Found </option>
                                        <?php
                                    }


                                    // 2. Display on Dropdown 
                                ?>

                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                    <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
            
            //Check whether the Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //Add the Food in the Database
                //echo "Clicked";

                // 1. Get the Data from Form 
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                

                // Check whether Radio Button for Featured and Active are Checked or Not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //Setting Default Value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //Setting Default Value
                }

                // 2. Upload the Image if Selected
                // Check whether the Select Image Button is Clicked or Not and Upload the Image only if the Image is Selected
                if(isset($_FILES['image']['name']))
                {
                    // Get the Details of the Selected Image 
                    $image_name = $_FILES['image']['name'];

                    // Check whether the Image is Selected or Not and Upload Image only if Selected
                    if($image_name!="")
                    {
                        // Image is Selected
                        // A. Rename the Image 
                        // Get the Extension of Selected Image(jpg, png, gif, etc.)
                        $ext = end(explode('.', $image_name));

                        // Create New Name for Image
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext; //New Image Name Maybe "Food-Name-696.jpg"

                        // B. Upload the Image
                        // Get the src Path and Destination Path 

                        // Source Path is the Current Location of the Image
                        $src=$_FILES['image']['tmp_name'];

                        // Destination Path for the Image to be Uploaded 
                        $dst = "../images/food/".$image_name;

                        // Finally Upload the Food Image
                        $upload = move_uploaded_file($src, $dst);

                        // Check whether Image is Uploaded or Not
                        if($upload==false)
                        {
                            // Failed to Upload Image
                            // Redirect to Add Food Page with Error Image
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            // Stop the Process
                            die();
                        }
                    }

                }
                else
                {
                    $image_name = ""; //Setting Default Value as Blank
                }

                // 3. Insert into Database

                // Create an SQL Query to Save or Add Food
                // For Numerical Value we do not need to pass value inside quote ' ' but for string value it is compulsory to add quotes ' '
                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                // Execute the Query 
                $res2 = mysqli_query($conn, $sql2);
                
                // Check whether Data is Inserted or Not
                // 4.  Redirect with Message to Manage Food Page
                if($res2 == true)
                {
                    //Data is Inserted Successfully
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //Failed to Insert Data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>