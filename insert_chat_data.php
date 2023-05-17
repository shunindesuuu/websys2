<?php
$hostname = "localhost";
$database = "Shopee";
$db_login = "root";
$db_pass = "";

// Connect to the database
$db_link = mysqli_connect($hostname, $db_login, $db_pass, $database) or die("Could not connect");

// Get the logged-in user's role (admin or customer) - Modify this according to your authentication logic
$userRole = $_COOKIE['type'];

// Insert chat messages
if ($userRole === "admin") {
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message']) && isset($_POST['recipient'])) {
    $newMessage = mysqli_real_escape_string($db_link, $_POST['message']);
    $recipient = mysqli_real_escape_string($db_link, $_POST['recipient']);
    $timestamp = date("Y-m-d H:i:s");

    $query = "INSERT INTO messages (sender, recipient, message, timestamp) VALUES ('Admin', '$recipient', '$newMessage', '$timestamp')";
    $insertResult = mysqli_query($db_link, $query);

    if (!$insertResult) {
      echo "Error inserting chat message: " . mysqli_error($db_link);
    }
  }
} else {
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $newMessage = mysqli_real_escape_string($db_link, $_POST['message']);
    $sender = $_COOKIE['email']; // Replace 'email' with the appropriate cookie name that stores the customer's email
    $timestamp = date("Y-m-d H:i:s");

    $query = "INSERT INTO messages (sender, recipient, message, timestamp) VALUES ('$sender', 'Admin', '$newMessage', '$timestamp')";
    $insertResult = mysqli_query($db_link, $query);

    if (!$insertResult) {
      echo "Error inserting chat message: " . mysqli_error($db_link);
    }
  }
}

// Retrieve chat messages based on user role and recipient
if ($userRole === "admin") {
  $query = "SELECT * FROM messages";
} else {
  $userId = $_COOKIE['email']; // Replace 'email' with the appropriate cookie name that stores the customer's email
  $query = "SELECT * FROM messages WHERE recipient = 'Admin' OR sender = '$userId'";
}

$result = mysqli_query($db_link, $query);

if ($result) {
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  mysqli_free_result($result);
} else {
  echo "Error retrieving chat messages: " . mysqli_error($db_link);
}

mysqli_close($db_link);

// Send the data as a JSON response
header('Content-Type: application/json');
echo json_encode($rows);
?>