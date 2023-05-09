<?php
$hostname = "localhost";
$database = "Shopee";
$db_login = "root";
$db_pass = "";
$dlink = mysqli_connect($hostname, $db_login, $db_pass, $database) or die("Could not connect");

if (isset($_POST['userid']) && isset($_POST['prodid']) && isset($_POST['quantity']) && isset($_POST['date']) && isset($_POST['new_status'])) {
    $userid = $_POST['userid'];
    $prodid = $_POST['prodid'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];
    $newStatus = $_POST['new_status'];

    // Update the status of the purchase
    $updateQuery = "UPDATE Purchase SET status='$newStatus' WHERE userid='$userid' AND prodid='$prodid' AND quantity='$quantity' AND date='$date'";
    $updateResult = mysqli_query($dlink, $updateQuery);

    if ($updateResult) {
        mysqli_close($dlink);
        header("Location: customerorders.php");
        exit();
    } else {
        echo "Error updating status: " . mysqli_error($dlink);
    }
} else {
    echo "Invalid parameters. Please provide userid, prodid, quantity, date, and new_status.";
}

mysqli_close($dlink);
?>