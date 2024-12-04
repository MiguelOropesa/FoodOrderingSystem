
<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 

             // Get the Search Keyword
             $search = $_POST['search'];

            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            
            //SQL Query to Get Food Based on Search Keyword
            $sql = "SELECT * FROM tbl_food WHERE title LIKE'%$search%' OR description LIKE'%$search%'";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //Check whether Food is Available or Not
            if($count>0)
            {
                //Food Available
                while($row = mysqli_fetch_assoc($res))
                {
                    //Get the Details
                    $id = $row["id"];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                                //Check whether Image is Available or Not
                                if($image_name=="")
                                {
                                    //Display Message
                                    echo "<div class='error'>Image Not Available</div>";
                                }
                                else
                                {
                                    //Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">Php<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                             <a href="#" class="btn btn-primary">Order Now</a>
                         </div>
                     </div>
                    <?php

                }
                
            }
            else
            {
                //Food Not Available
                echo "<div class='error'>Food Not Found</div>";
            }

            ?>



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>