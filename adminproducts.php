<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<style>
    /* Container for each item */
    .item-container {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
    }

    /* Product name */
    .item-container a {
        color: #333;
        text-decoration: none;
        font-weight: bold;
    }

    /* Product image */
    .item-container img {
        width: 200px;
        height: auto;
        margin-bottom: 5px;
    }

    /* Product quantity */
    .item-container p {
        display: inline;
        margin-right: 10px;
    }

    /* Out of stock message */
    .item-container p.out-of-stock {
        color: red;
    }

    /* Category */
    .category {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .category-link {
        text-decoration: none;
        color: #333;
    }

    .product-quantity out-of-stock {
        color: red;
    }

    #new-category-btn {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-bottom: 10px;
        cursor: pointer;
    }

    #new-category-btn:hover {
        background-color: #45a049;
    }

    #new-category-btn:focus {
        outline: none;
    }

    .edit-category-btn {
        background-color: #007bff;
        border: none;
        color: white;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin-right: 10px;
        margin-left: 10px;
        cursor: pointer;
    }

    .edit-category-btn:hover {
        background-color: #0056b3;
    }

    .edit-category-btn:focus {
        outline: none;
    }

    /* CSS for the "Delete" button */
    .delete-category-btn {
        background-color: #dc3545;
        border: none;
        color: white;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        cursor: pointer;
    }

    .delete-category-btn:hover {
        background-color: #c82333;
    }

    .delete-category-btn:focus {
        outline: none;
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
                    <span>Menu</span>
                </div>
                <div>
                    <a href="adminproducts.php" class="whatshot"></a>
                    <div>
                        <ul>
                            <?php

                            // Check if the user is logged in and has the usertype of "admin"
                            if (!isset($_COOKIE['type']) || $_COOKIE['type'] !== 'admin') {
                                header("Location: index.php");
                                exit();
                            }
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

                            // Button for the category
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($current_cat != $row['prodcat']) {
                                    echo '<div class="category" id="category-' . $row['prodcat'] . '">';
                                    echo '<a class="category-link" href="?category=' . $row['prodcat'] . '">' . $row['prodcat'] . '</a>';
                                    echo '<button class="edit-category-btn" onclick="editCategoryName(\'' . $row['prodcat'] . '\')">Edit</button>';
                                    echo '<button class="delete-category-btn" onclick="confirmDeleteCategory(\'' . $row['prodcat'] . '\')">Delete</button>';
                                    echo '</div>';
                                    $current_cat = $row['prodcat'];
                                }

                                echo '<li>';

                                echo '<a href="#"><img id="product-image" src="' . $row['productimage'] . '" alt="' . $row['productname'] . '"></a>';
                                echo '<select class="product-options" onchange="handleProductOptionChange(' . $row['prodid'] . ', this)">
                                <option value="" selected>--------</option> <!-- Make the empty value option selected -->
                                <option value="edit" >Edit</option>
                                <option value="insert">Insert</option>
                                <option value="delete">Delete</option>
                                </select>';
                                echo '<div id="product-details">';

                                // Display product name, price, and quantity
                                if ($row['quantity'] > 0) {
                                    echo '<p class="product-quantity" style="display: inline;">Quantity: ' . $row['quantity'] . '</p>';
                                    echo '<a id="product-name">' . $row['productname'] . '</a>';
                                    echo '<p class="product-price">$' . $row['curprice'] . '</p>'; // Display product quantity
                                } else {
                                    echo '<p class="product-quantity out-of-stock" style="display: inline; color: red; font-weight: bold;">Out of Stock</p>';
                                }

                                echo '</div>';
                                echo '</li>';
                            }

                            // Add "New Category" button
                            echo '<div class="category">';
                            echo '<button id="new-category-btn" onclick="createNewCategory()">New Category</button>';
                            echo '</div>';

                            echo '</ul>';

                            mysqli_close($dlink);
                            ?>

                            <script>

                                function openFormPopup() {
                                    document.getElementById('popup-container').style.display = 'flex';
                                }

                                function closeFormPopup() {
                                    document.getElementById('popup-container').style.display = 'none';
                                }

                                function handleProductOptionChange(prodid, selectElement) {
                                    var value = selectElement.value;

                                    if (value === "insert") {
                                        handleInsertProduct(prodid, selectElement);
                                    } else if (value === "delete") {
                                        handleDeleteProduct(prodid);
                                    } else if (value === "edit") {
                                        handleProductEdit(prodid);
                                    }
                                }

                                function handleInsertProduct(prodid, selectElement) { // Add selectElement as a parameter
                                    // Retrieve the category of the selected product
                                    var prodcat = selectElement.getAttribute("data-category");

                                    // Make an AJAX request to insert a new product
                                    var xhr = new XMLHttpRequest();
                                    xhr.open("POST", "insert_product.php", true);
                                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                    xhr.onreadystatechange = function () {
                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                            // Insertion completed successfully
                                            // Reload the page
                                            location.reload();
                                        }
                                    };
                                    xhr.send("prodid=" + prodid + "&category=" + prodcat + "&option=insert");
                                }

                                function handleDeleteProduct(prodid) {
                                    var confirmationMessage = "Are you sure you want to delete this product (prodid = " + prodid + ")?";

                                    if (confirm(confirmationMessage)) {
                                        // Make an AJAX request to delete the product
                                        var xhr = new XMLHttpRequest();
                                        xhr.open("POST", "delete_product.php", true);
                                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                        xhr.onreadystatechange = function () {
                                            if (xhr.readyState === 4 && xhr.status === 200) {
                                                // Product deleted successfully, reload the page
                                                location.reload();
                                            }
                                        };
                                        xhr.send("prodid=" + prodid);
                                    } else {
                                        // Reset the select value to the default option
                                        selectElement.value = "";
                                    }
                                }

                                function handleProductEdit(prodid) {
                                    // Show the edit form popup
                                    document.getElementById('popup-container').style.display = 'block';

                                    // Set the prodid value in the edit form
                                    document.getElementById('prodid').value = prodid;
                                    document.getElementById('popup-prodid').textContent = prodid;

                                }
                                function editCategoryName(categoryId) {
                                    var categoryElement = document.getElementById('category-' + categoryId);
                                    var categoryLink = categoryElement.querySelector('.category-link');
                                    var editButton = categoryElement.querySelector('.edit-category-btn');

                                    if (categoryLink.style.display === 'none') {
                                        // Already in edit mode, save changes
                                        var inputElement = categoryElement.querySelector('input');
                                        var newCategoryName = inputElement.value;

                                        if (newCategoryName.trim() !== '') {
                                            // Send an AJAX request to update the category name
                                            var xhr = new XMLHttpRequest();
                                            xhr.open('POST', 'update_category.php', true);
                                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                            xhr.onload = function () {
                                                if (xhr.status === 200) {
                                                    // Reload the page after updating the category name
                                                    location.reload();
                                                } else {
                                                    // Display error message if updating category name failed
                                                    console.log('Error updating category name: ' + xhr.responseText);
                                                }
                                            };
                                            xhr.send('categoryId=' + encodeURIComponent(categoryId) + '&newCategoryName=' + encodeURIComponent(newCategoryName));
                                        }
                                    } else {
                                        // Enter edit mode
                                        categoryLink.style.display = 'none';
                                        editButton.innerText = 'Save';

                                        var inputElement = document.createElement('input');
                                        inputElement.type = 'text';
                                        inputElement.value = categoryLink.innerText;

                                        categoryElement.appendChild(inputElement);
                                    }
                                }
                                function createNewCategory() {
                                    // Send an AJAX request to create a new category
                                    var xhr = new XMLHttpRequest();
                                    xhr.open('POST', 'create_category.php', true);
                                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                    xhr.onload = function () {
                                        if (xhr.status === 200) {
                                            // Reload the page after creating a new category
                                            location.reload();
                                        }
                                    };
                                    xhr.send();
                                }

                                function confirmDeleteCategory(categoryId) {
                                    var confirmationMessage = "Are you sure you want to delete this category (" + categoryId + ") and its products?";

                                    var confirmation = confirm(confirmationMessage);
                                    if (confirmation) {
                                        // Send an AJAX request to delete the category
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', 'update_category.php', true);
                                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                        xhr.onload = function () {
                                            if (xhr.status === 200) {
                                                // Reload the page after deleting the category
                                                location.reload();
                                            } else {
                                                // Display error message if deleting category failed
                                                console.log('Error deleting category: ' + xhr.responseText);
                                            }
                                        };
                                        xhr.send('categoryId=' + encodeURIComponent(categoryId) + '&newCategoryName=');
                                    }
                                }

                            </script>
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
    <!-- Add the popup container -->
    <div id="popup-container" style="display: none;">
        <div id="popup-window">
            <div class="modal-content">
                <button type="button" class="close" onclick="closeFormPopup()">&times;</button>
                <div>
                    <div class="row text-center">
                        <h1>Edit Product <span id="popup-prodid"></span></h1>
                        <hr>
                        <p>Update the product details below:</p>
                    </div>
                    <br>
                    <?php
                    $hostname = "localhost";
                    $database = "Shopee";
                    $db_login = "root";
                    $db_pass = "";
                    $dlink = mysqli_connect($hostname, $db_login, $db_pass, $database) or die("Could not connect");

                    // Retrieve the product ID from the URL parameter
                    $prodid = isset($_GET['prodid']) ? $_GET['prodid'] : 0;

                    // Retrieve the product details from the database based on the $prodid
                    $query = "SELECT productname, description, quantity, curprice FROM products WHERE prodid = $prodid";
                    $result = mysqli_query($dlink, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $productname = $row['productname'];
                        $description = $row['productdesc'];
                        $quantity = $row['quantity'];
                        $curprice = $row['curprice'];
                    }

                    mysqli_close($dlink);
                    ?>
                    <form action="update_product.php" method="post" id="edit-form" enctype="multipart/form-data"
                        onsubmit="handleProductUpdate(event)">
                        <input type="hidden" id="prodid" name="prodid" value="<?php echo $prodid; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="productname">Product Name:</label>
                                <input class="form-control" name="productname" id="productname"
                                    placeholder="Product Name" value="<?php echo $productname; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="description">Description:</label>
                                <input class="form-control" name="description" id="description"
                                    placeholder="Description" value="<?php echo $description; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="quantity">Quantity:</label>
                                <input class="form-control" name="quantity" id="quantity" placeholder="Quantity"
                                    type="number" min="0" value="<?php echo $quantity; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="curprice">Current Price:</label>
                                <input class="form-control" name="curprice" id="curprice" placeholder="Current Price"
                                    value="<?php echo $curprice; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="image">Product Image:</label>
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