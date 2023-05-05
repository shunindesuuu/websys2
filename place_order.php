<?php
session_start();

if (isset($_POST['place_order'])) {
    $selected_products = isset($_POST['selected_products']) ? $_POST['selected_products'] : array();

    if (count($selected_products) > 0) {
        $dlink = mysqli_connect("localhost", "username", "password", "database");

        foreach ($selected_products as $prodid) {
            if (isset($_SESSION['cart'][$prodid])) {
                $quantity = $_SESSION['cart'][$prodid];

                $query = "UPDATE Products SET quantity=quantity-$quantity WHERE prodid='$prodid'";
                mysqli_query($dlink, $query);

                unset($_SESSION['cart'][$prodid]);
            }
        }

        mysqli_close($dlink);

        echo '<h1>Thank you for your order!</h1>';
    } else {
        echo '<h1>Please select at least one product to purchase.</h1>';
    }
}
?>