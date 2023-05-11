<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<style>
    #popup-container {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        padding: 20px;
        display: none;
    }
</style>

<head>
    <meta charset="UTF-8">
    <title>Products - Yay&#33;Koffee Website Template</title>
    <link rel="stylesheet" type="text/css" href="css/adminproducts.css">
</head>

<body>
    <div id="page">
        <div>
            <div id="header">
                <a href="index.php"><img src="images/logo.png" alt="Image"></a>
                <ul>
                    <li>
                        <a href="index.php?user=logged_in">Home</a>
                        <?php if (!isset($_COOKIE['email'])): ?>
                        <?php else: ?>
                        <li>
                            <a>Welcome,
                                <?php echo $_COOKIE['type'] . '  ' . $_COOKIE['email'] . '' ?>
                            </a>
                        </li>
                        <li><a href="logout.php">Logout</a></li>
                    <?php endif ?>
                    </li>
                    <!-- <li>
                        <a href="cart.php">Cart</a>
                    </li> -->
                    <?php
                    if (isset($_COOKIE['type'])) {
                        if ($_COOKIE['type'] == 'admin') {
                            echo '<li><a href="adminproducts.php">Products</a></li>';
                            echo '<li><a href="customerorders.php">Cust Orders</a></li>';
                            echo '<li><a href="calendar.php">Calendar</a></li>';
                        } elseif ($_COOKIE['type'] == 'customer') {
                            echo '<li><a href="adminproducts.php">Products</a></li>';
                            echo '<li><a href="cart.php">Cart</a></li>';
                            echo '<li><a href="myorders.php">My Orders</a></li>';
                        }
                    }
                    ?>
                    <!-- <li>
                        <a href="locations.html">Locations</a>
                    </li>
                    <li>
                        <a href="blog.html">Blog</a>
                    </li>
                    <li>
                        <a href="about.html">About Us</a>
                    </li> -->
                </ul>
            </div>
            <div id="body">
                <div id="figure">
                    <img src="images/headline-menu.jpg" alt="Image">
                    <span>adminproducts</span>
                </div>
                <div>
                    <a href="adminproducts.php" class="whatshot"></a>
                    <div>
                        <ul>
                            <script>
                                function selectAction(prodid, action) {
                                    if (action === 'delete') {
                                        // Delete action logic
                                    } else if (action === 'edit') {
                                        openFormPopup(prodid); // Call the openFormPopup function
                                    } else if (action === 'insert') {
                                        // Insert action logic
                                    }
                                }

                                function openFormPopup(prodid) {
                                    // Show the form popup
                                    var popupContainer = document.getElementById("popup-container");
                                    popupContainer.style.display = "block";

                                    // Set the product ID value in the form
                                    var prodIdInput = document.getElementById("prodid");
                                    prodIdInput.value = prodid;
                                }
                                function closeFormPopup() {
                                    // Hide the form popup
                                    var popupContainer = document.getElementById("popup-container");
                                    popupContainer.style.display = "none";
                                }
                            </script>
                            <?php
                            $hostname = "localhost";
                            $database = "Shopee";
                            $db_login = "root";
                            $db_pass = "";
                            $dlink = mysqli_connect($hostname, $db_login, $db_pass, $database) or die("Could not connect");

                            // Check if a category filter is set
                            if (isset($_GET['category'])) {
                                $category_filter = $_GET['category'];
                                $query = "SELECT * FROM Products WHERE prodcat='$category_filter' ORDER BY prodid";
                            } else {
                                $query = "SELECT * FROM Products ORDER BY prodcat, prodid";
                            }

                            $result = mysqli_query($dlink, $query);
                            $current_cat = '';

                            echo '<ul>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($current_cat != $row['prodcat']) {
                                    echo '<h1><a href="?category=' . $row['prodcat'] . '">' . $row['prodcat'] . '</a></h1>';
                                    $current_cat = $row['prodcat'];
                                }

                                echo '<li>';
                                echo '<a href="#"><img src="' . $row['productimage'] . '" alt="' . $row['productname'] . '"></a>';
                                echo '<div>';

                                echo '<select onchange="selectAction(' . $row['prodid'] . ', this.value);">';
                                echo '<option value="">Select Action</option>';
                                echo '<option value="delete">Delete</option>';
                                echo '<option value="edit">Edit</option>';
                                echo '<option value="insert">Insert</option>';
                                echo '</select>';
                                echo '<p style="display: inline;">Quantity: ' . $row['quantity'] . '</p>';
                                echo '<p>' . $row['productname'] . '</p>';
                                echo '</div>';
                                echo '</li>';
                            }

                            echo '</ul>';

                            // Process the submitted form
                            if (isset($_POST['submit'])) {
                                $prodid = $_POST['prodid'];
                                $productname = $_POST['productname'];
                                $description = $_POST['description'];
                                $quantity = $_POST['quantity'];
                                $curprice = $_POST['curprice'];

                                // Construct the update query based on the submitted form values
                                $updateQuery = "UPDATE Products SET ";

                                $updateFields = array();

                                if (!empty($productname)) {
                                    $updateFields[] = "productname='$productname'";
                                }
                                if (!empty($description)) {
                                    $updateFields[] = "productdesc='$description'";
                                }
                                if (!empty($quantity)) {
                                    $updateFields[] = "quantity='$quantity'";
                                }
                                if (!empty($curprice)) {
                                    $updateFields[] = "curprice='$curprice'";
                                }

                                $updateQuery .= implode(", ", $updateFields);
                                $updateQuery .= " WHERE prodid='$prodid'";

                                // Execute the update query
                                $result = mysqli_query($dlink, $updateQuery);

                                // Check if the update was successful
                                if ($result) {
                                    echo '<script>alert("Product updated successfully.");</script>';
                                } else {
                                    echo '<script>alert("Failed to update product. Please try again.");</script>';
                                }

                                // Handle the image upload if a file is selected
                                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                                    $image = $_FILES['image']['tmp_name'];

                                    // Read the image file
                                    $imageData = file_get_contents($image);

                                    if ($imageData !== false) {
                                        // Prepare the query to update the image and its directory
                                        $updateImageQuery = "UPDATE Products SET productimage=?, image_directory=? WHERE prodid=?";
                                        $stmt = mysqli_prepare($dlink, $updateImageQuery);
                                        // Set the parameters for the query
                                        $imageDirectory = "path/to/save/image.jpg"; // Replace with your desired image directory
                                        mysqli_stmt_bind_param($stmt, "ssi", $imageData, $imageDirectory, $prodid);
                                        mysqli_stmt_execute($stmt);
                                        $resultImage = mysqli_stmt_affected_rows($stmt);
                                        mysqli_stmt_close($stmt);

                                        // Check if the image update was successful
                                        if ($resultImage) {
                                            echo '<script>alert("Product image updated successfully.");</script>';
                                        } else {
                                            echo '<script>alert("Failed to update product image. Please try again.");</script>';
                                        }
                                    } else {
                                        echo '<script>alert("Failed to read the image file. Please try again.");</script>';
                                    }
                                }
                                // Close the pop-up window after saving
                                echo '<script>window.opener.location.reload(); window.close();</script>';
                            }

                            mysqli_close($dlink);
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="footer">
                <div>
                    <a href="index.html"><img src="images/logo2.png" alt="Image"></a>
                    <p class="footnote">
                        &copy; Yay&#33;Koffee 2011.<br>All Rights Reserved.
                    </p>
                </div>
                <div class="section">
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li class="current">
                            <a href="adminproducts.html">adminproducts</a>
                        </li>
                        <li>
                            <a href="locations.html">Locations</a>
                        </li>
                        <li>
                            <a href="blog.html">Blog</a>
                        </li>
                        <li>
                            <a href="about.html">About Us</a>
                        </li>
                    </ul>
                    <div id="connect">
                        <a href="http://freewebsitetemplates.com/go/facebook/" target="_blank"
                            id="facebook">Facebook</a>
                        <a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" id="twitter">Twitter</a>
                        <a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank"
                            id="googleplus">Google+</a>
                        <a href="index.html" id="rss">RSS</a>
                    </div>
                    <p>
                        This website template has been designed by <a href="http://www.freewebsitetemplates.com/">Free
                            Website Templates</a> for you, for free. You can replace all this text with your own text.
                        You can remove any link to our website from this website template, you&#39;re free to use this
                        website template without linking back to us. If you&#39;re having problems editing this website
                        template, then don&#39;t hesitate to ask for help on the <a
                            href="http://www.freewebsitetemplates.com/forums/">Forums</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="popup-container" style="display: none;">
        <div id="popup-window">
            <div class="modal-content">
                <button type="button" class="close" onclick="closeFormPopup()">&times;</button>
                <div>
                    <div class="row text-center">
                        <h1>Edit Product</h1>
                        <hr>
                        <p>Update the product details below:</p>
                    </div>
                    <br>
                    <form action="" method="post" id="edit-form" enctype="multipart/form-data">
                        <input type="hidden" id="prodid" name="prodid">
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" name="productname" id="productname"
                                    placeholder="Product Name" required>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" name="description" id="description"
                                    placeholder="Description" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" name="quantity" id="quantity" placeholder="Quantity"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" name="curprice" id="curprice" placeholder="Current Price"
                                    required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="file" name="image" id="image" accept="image/*">
                            </div>
                        </div>
                        <br>
                        <center>
                            <input type="submit" class="btn btn-primary" name="submit" value="Save">
                        </center>
                    </form>
                    <br>
                </div>
            </div>
        </div>

    </div>
</body>

</html>