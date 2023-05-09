<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>

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

                                // Display product name, price, and quantity
                                echo '<select>';
                                echo '<option value="">Select Action</option>';
                                echo '<option value="delete">Delete</option>';
                                echo '<option value="edit">Edit</option>';
                                echo '</select>';
                                echo '<p style="display: inline;">Quantity: ' . $row['quantity'] . '</p>';
                                echo '<p>' . $row['productname'] . '</p>';

                                // Edit form for admin
                                echo '<div class="edit-form" style="display: none;">';
                                echo '<form method="POST" enctype="multipart/form-data">';
                                echo '<input type="file" name="image" accept="image/*" maxlength="2097152" /><br>';
                                echo '<input type="text" name="productname" placeholder="Product Name"><br>';
                                echo '<textarea name="description" placeholder="Product Description"></textarea><br>';
                                echo '<input type="number" name="quantity" placeholder="Quantity"><br>';
                                echo '<input type="text" name="curprice" placeholder="Price"><br>';
                                echo '<input type="hidden" name="prodid" value="' . $row['prodid'] . '">';
                                echo '<input type="submit" name="submit" value="Save">';
                                echo '</form>';
                                echo '</div>';

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

                                // Update the product information in the database
                                $updateQuery = "UPDATE Products SET productname='$productname', description='$description', quantity='$quantity', curprice='$curprice' WHERE prodid='$prodid'";
                                mysqli_query($dlink, $updateQuery);

                                // Handle the image upload if a file is selected
                                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                                    $image = $_FILES['image']['tmp_name'];
                                    $imageData = mysqli_real_escape_string($dlink, file_get_contents($image));
                                    $updateImageQuery = "UPDATE Products SET productimage='$imageData' WHERE prodid='$prodid'";
                                    mysqli_query($dlink, $updateImageQuery);
                                }
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
</body>

</html>