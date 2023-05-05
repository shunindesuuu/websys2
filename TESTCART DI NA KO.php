<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>

<head>
    <meta charset="UTF-8">
    <title>Menu - Yay&#33;Koffee Website Template</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
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
                            echo '<li><a href="calendar.php">Calendar</a></li>';
                        } elseif ($_COOKIE['type'] == 'customer') {
                            echo '<li><a href="menu.php">Menu</a></li>';
                            echo '<li><a href="cart.php">Cart</a></li>';
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
                    <span>Cart</span>
                </div>
                <div>
                     <?php
                    session_start();
                    $hostname = "localhost";
                    $database = "Shopee";
                    $db_login = "root";
                    $db_pass = "";
                    $dlink = mysqli_connect($hostname, $db_login, $db_pass, $database) or die("Could not connect");

                    if (isset($_GET['prodid'])) {
                        $prodid = $_GET['prodid'];

                        // check if product is already in cart, if yes, update quantity, else add to cart
                        if (isset($_SESSION['cart'][$prodid])) {
                            $_SESSION['cart'][$prodid] += 1;
                        } else {
                            $_SESSION['cart'][$prodid] = 1;
                        }
                    }

                    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['prodid'])) {
                        $prodid = $_GET['prodid'];
                        unset($_SESSION['cart'][$prodid]);
                    }

                    // display the contents of the cart
                    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                        echo '<table>';
                        echo '<thead><tr><th>Product</th><th></th><th>Product Name</th><th>Price</th><th>Quantity</th><th>Total Price</th><th>Action</th></tr></thead>';
                        echo '<tbody>';
                        $total_price = 0;
                        foreach ($_SESSION['cart'] as $prodid => $quantity) {
                            // get the product details from the database
                            $query = "SELECT * FROM Products WHERE prodid='$prodid'";
                            $result = mysqli_query($dlink, $query);
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);

                                // calculate the total price for this product
                                $product_price = $row['curprice'] * $quantity;
                                $total_price += $product_price;

                                // display the product in the cart
                                echo '<tr>';
                                echo '<td><img src="' . $row['productimage'] . '" alt="' . $row['productname'] . '"></td>';
                                echo '<td>' . $row['productdesc'] . '</td>';
                                echo '<td>' . $row['productname'] . '</td>';
                                echo '<td>$' . $row['curprice'] . '</td>';
                                echo '<td><form method="post" action="update_quantity.php?prodid=' . $row['prodid'] . '"><select name="quantity">';
                                for ($i = 1; $i <= 10; $i++) {
                                    if ($i == $quantity) {
                                        echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                    } else {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                }
                                echo '<td>$' . number_format($product_price, 2) . '</td>';
                                echo '<td><a href="cart.php?action=delete&prodid=' . $row['prodid'] . '">Delete</a></td>';
                                echo '</tr>';
                            }
                        }
                        echo '<tr><td colspan="5" style="text-align:right">Total:</td><td>$' . number_format($total_price, 2) . '</td><td></td></tr>';
                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo '<h1>Your shopping cart is empty</h1>';
                    }
                    mysqli_close($dlink);
                    ?>
                    <!-- <div> -->
                    <!-- <table id="cartTable">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="images/coffee1.jpg" alt="Product Image"></td>
                                    <td>Product Name 1</td>
                                    <td>2</td>
                                    <td>$19.99</td>
                                </tr>
                                <tr>
                                    <td><img src="images/coffee2.jpg" alt="Product Image"></td>
                                    <td>Product Name 2</td>
                                    <td>1</td>
                                    <td>$9.99</td>
                                </tr>
                                <tr>
                                    <td><img src="images/coffee3.jpg" alt="Product Image"></td>
                                    <td>Product Name 3</td>
                                    <td>3</td>
                                    <td>$29.99</td>
                                </tr>
                            </tbody>
                        </table> -->
                    <!-- </div> -->
                    <!-- <a href="menu.html" class="whatshot">What&#39;s Hot</a>
                    <div>
                        <ul>
                            <li>
                                <a href="index.html"><img src="images/coffee1.jpg" alt="Image"></a>
                                <div>
                                    <a href="index.html">Lorem ipsum</a>
                                    <p>
                                        Lorem ipsum &#36;0.00
                                    </p>
                                </div>
                            </li>
                            <li>
                                <a href="index.html"><img src="images/coffee2.jpg" alt="Image"></a>
                                <div>
                                    <a href="index.html">Dolor sit amet</a>
                                    <p>
                                        Lorem ipsum &#36;0.00
                                    </p>
                                </div>
                            </li>
                            <li>
                                <a href="index.html"><img src="images/coffee3.jpg" alt="Image"></a>
                                <div>
                                    <a href="index.html">Donie quis</a>
                                    <p>
                                        Lorem ipsum &#36;0.00
                                    </p>
                                </div>
                            </li>
                            <li>
                                <a href="index.html"><img src="images/coffee4.jpg" alt="Image"></a>
                                <div>
                                    <a href="index.html">Lorem ipsum</a>
                                    <p>
                                        Lorem ipsum &#36;0.00
                                    </p>
                                </div>
                            </li>
                            <li>
                                <a href="index.html"><img src="images/coffee5.jpg" alt="Image"></a>
                                <div>
                                    <a href="index.html">Dolor sit amet</a>
                                    <p>
                                        Lorem ipsum &#36;0.00
                                    </p>
                                </div>
                            </li>
                            <li>
                                <a href="index.html"><img src="images/coffee6.jpg" alt="Image"></a>
                                <div>
                                    <a href="index.html">Donie quis</a>
                                    <p>
                                        Lorem ipsum &#36;0.00
                                    </p>
                                </div>
                            </li>
                            <li>
                                <a href="index.html"><img src="images/coffee3.jpg" alt="Image"></a>
                                <div>
                                    <a href="index.html">Lorem ipsum</a>
                                    <p>
                                        Lorem ipsum &#36;0.00
                                    </p>
                                </div>
                            </li>
                            <li>
                                <a href="index.html"><img src="images/coffee2.jpg" alt="Image"></a>
                                <div>
                                    <a href="index.html">Dolor sit amet</a>
                                    <p>
                                        Lorem ipsum &#36;0.00
                                    </p>
                                </div>
                            </li>
                            <li>
                                <a href="index.html"><img src="images/coffee1.jpg" alt="Image"></a>
                                <div>
                                    <a href="index.html">Donie quis</a>
                                    <p>
                                        Lorem ipsum &#36;0.00
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div> -->
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
                            <a href="menu.html">Menu</a>
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