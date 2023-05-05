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
                    <!-- PHP CODE HERE FOR CART -->
                    <?php
                    // Initialize cart array if not yet created
                    if (!isset($_COOKIE['cart'])) {
                        setcookie('cart', serialize(array()), time() + (86400 * 30), "/"); // 30 days
                    }

                    // Check if product ID is passed through GET
                    if (isset($_GET['prodid'])) {
                        // Add product to cart array
                        $prodid = $_GET['prodid'];
                        $cart = unserialize($_COOKIE['cart']);

                        if (isset($cart[$prodid])) {
                            $cart[$prodid]['quantity']++;
                        } else {
                            // Get product details from database
                            $hostname = "localhost";
                            $database = "Shopee";
                            $db_login = "root";
                            $db_pass = "";
                            $dlink = mysqli_connect($hostname, $db_login, $db_pass, $database) or die("Could not connect");

                            $query = "SELECT * FROM Products WHERE prodid='$prodid'";
                            $result = mysqli_query($dlink, $query);
                            $product = mysqli_fetch_assoc($result);

                            // Add product to cart array
                            $cart[$prodid] = array(
                                'image' => $product['productimage'],
                                'name' => $product['productname'],
                                'description' => $product['productdesc'],
                                'price' => $product['curprice'],
                                'quantity' => 1
                            );
                        }

                        setcookie('cart', serialize($cart), time() + (86400 * 30), "/"); // 30 days
                        header("Location: {$_SERVER['PHP_SELF']}");
                        exit;
                    }

                    // Check if product ID is passed through POST (delete action)
                    if (isset($_POST['delete'])) {
                        // Remove product from cart array
                        $prodid = $_POST['delete'];
                        $cart = unserialize($_COOKIE['cart']);
                        unset($cart[$prodid]);
                        setcookie('cart', serialize($cart), time() + (86400 * 30), "/"); // 30 days
                        header("Location: {$_SERVER['PHP_SELF']}");
                        exit;
                    }

                    // Display cart table
                    $cart = unserialize($_COOKIE['cart']);
                    echo '<table>';
                    echo '<tr><th>Picture</th><th>Description</th><th>Name</th><th>Quantity</th><th>Price</th><th>Action</th></tr>';
                    $total_price = 0;
                    foreach ($cart as $prodid => $product) {
                        $subtotal = $product['price'] * $product['quantity'];
                        $total_price += $subtotal;

                        echo '<tr>';
                        echo '<td><img src="' . $product['image'] . '" alt="' . $product['name'] . '"></td>';
                        echo '<td>' . $product['description'] . '</td>';
                        echo '<td>' . $product['name'] . '</td>';
                        echo '<td>' . $product['quantity'] . '</td>';
                        echo '<td>$' . number_format($subtotal, 2) . '</td>';
                        echo '<td><form method="post"><button type="submit" name="delete" value="' . $prodid . '">Delete</button></form></td>';
                        echo '</tr>';
                    }
                    echo '<tr><td colspan="4">Total Price:</td><td>$' . number_format($total_price, 2) . '</td>';
                    echo '</table>';
                    ?>

                    <!-- END OF PHP -->
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