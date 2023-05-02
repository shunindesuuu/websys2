<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>

<head>
    <meta charset="UTF-8">
    <title>Yay&#39;Koffee Website Template</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div id="page">
        <div>
            <div id="header">
                <a href="index.php"><img src="images/logo.png" alt="Image"></a>
                <ul>
                    <li class="current">
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
                    <li>
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
                    </li>
                    <!-- php section -->

                    <div id="login_form">

                        <?php
                        // $hostname = "localhost";
                        // $database = "Shopee";
                        // $db_login = "root";
                        // $db_pass = "";

                        // $dlink = mysql_connect($hostname, $db_login, $db_pass) or die("Could not connect");
                        // mysql_select_db($database) or die("Could not select database");

                        // // Register
                        
                        // if ($_REQUEST['name'] != "" && $_REQUEST['email'] != "" && $_REQUEST['password'] != "" && $_REQUEST['contact'] != "" && $_REQUEST['address'] != "") {
                        //     $query = "SELECT * FROM user WHERE email='" . $_REQUEST['email'] . "'";
                        //     $result = mysql_query($query) or die(mysql_error());
                        //     $num_results = mysql_num_rows($result);

                        //     if ($num_results == 0) {
                        //         // Check if this is the first registered user
                        //         $query = "SELECT * FROM user";
                        //         $result = mysql_query($query) or die(mysql_error());
                        //         $num_results = mysql_num_rows($result);

                        //         $user_type = 'customer';

                        //         if ($num_results == 0) {
                        //             // First registered user is admin
                        //             $user_type = 'admin';
                        //         }

                        //         $query = "INSERT INTO user(email, paswrd, contact, custname, address, usertype, user_date, user_ip) VALUES('" . $_REQUEST['email'] . "', '" . $_REQUEST['password'] . "', '" . $_REQUEST['contact'] . "', '" . $_REQUEST['name'] . "' ,'" . $_REQUEST['address'] . "', '" . $user_type . "', '" . date("Y-m-d h:i:s") . "', '" . $_SERVER['REMOTE_ADDR'] . "')";
                        //         $result = mysql_query($query) or die(mysql_error());
                        //         echo "<meta http-equiv='refresh' content='0;url=index.php?action=login&#login_form'>";
                        //     } else {
                        //         echo "<meta http-equiv='refresh' content='0;url=index.php?registered=user&register=true&#register'>";
                        //         echo '<script>alert("Account Already Registered")</script>';
                        //     }
                        // }


                        // End of Register
                        
                        // Login
                        
                        // if ($_REQUEST['logging_in'] == true) {
                        //     $query = "select * from user where email='" . $_REQUEST['email'] . "' and paswrd='" . $_REQUEST['password'] . "'";
                        //     $result = mysql_query($query) or die(mysql_error());
                        //     $total_results = mysql_num_rows($result);
                        //     if ($total_results == 0) {
                        //         echo '<meta http-equiv="refresh" content="0;url=index.php?action=register&#login_form">';
                        //     } else {
                        //         $row = mysql_fetch_array($result);
                        //         setcookie("email", $row['email'], time() + 3600);
                        //         setcookie("type", $row['usertype'], time() + 3600);
                        //         echo '<meta http-equiv="refresh" content="0,url=index.php?user=logged_in">';
                        //     }
                        // }

                        // End of Login
                        
                        // Register Form
                        
                        // if ($_REQUEST['action'] == 'register') {
                        //     print('<h1>Registration Form</h1>');
                        //     print('<form action=index.php method=post>');
                        //     print('Enter Name<input type=text name=name><br>');
                        //     print('Enter Email<input type=text name=email><br>');
                        //     print('Enter Password<input type=text name=password><br>');
                        //     print('Enter Contact<input type=text name=contact><br>');
                        //     print('Enter Address<input type=text name=address><br>');
                        //     print('<input type=submit value=submit>');
                        //     print('</form>');
                        // }

                        // End of Register Form
                        
                        // Login Form
                        
                        // if ($_REQUEST['action'] == 'login') {
                        //     print('<h1 id="login">Login</h1>');
                        //     print('<form action=index.php?logging_in=true method=post>');
                        //     print('Enter Email<input type=text name=email><br>');
                        //     print("Enter Password<input type=text name=password><br>");
                        //     print('<input type=submit value=submit name=submit>');
                        //     print('</form>');
                        // }

                        // End of Login Form
                        // ?>
                         <?php
                        // if ($_REQUEST['user'] != "logged_in") {
                        //     echo '<li class="nav-item"><a class="nav-link" href="index.php?action=login&#login_form">Login</a></li>';
                        //     echo '<li class="nav-item"> <a class="nav-link" href="index.php?action=register&#login_form">Register</a></li>';
                        // } else if ($_REQUEST['user'] == "logged_in") {
                        // }
                        // ?>
                    </div>

                    <!-- end php section -->
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
            <div id="calendar">
                <?php
                // Get the current year and month
                $year = date('Y');
                $month = date('m');

                // Get the number of days in the current month
                $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                // Get the name of the current month, F in format('F') means the full name of the month
                $date = new DateTime("$year-$month-01");
                $month_name = $date->format('F');

                // Get the index of the first day of the month (0 = Sunday, 1 = Monday, etc.)
//The first argument, 'w', specifies that we want to retrieve the day of the week as a numeric value (0 for Sunday, 1 for Monday, and so on).
//strtotime function creates a timestamp representing the first day of the given month and year.
                $first_day_index = (int) date('w', strtotime("$year-$month-01"));

                // Start the table and print the month name
                echo "<table width=80% border=1><caption>$month_name $year</caption>";

                // Print the table headers (days of the week)
                echo "<th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th>";
                echo "<th>Thu</th><th>Fri</th><th>Sat</th>";
                echo "</tr>";

                // Start a new row for the first week

                // Print blank cells for the days before the first day of the month
                for ($i = 0; $i < $first_day_index; $i++) {
                    echo "<td></td>";
                }

                // Print the cells for the days of the month
                for ($day = 1; $day <= $num_days; $day++) {
                    // Start a new row at the beginning of each week
                    if ($day > 1 && ($day - 1 + $first_day_index) % 7 == 0) {
                        echo "</tr><tr>";
                    }

                    // Print the cell for the current day
                    echo "<td align=center>$day</td>";
                }

                // Print blank cells for the days after the last day of the month
                for ($i = $num_days + $first_day_index; $i < 42; $i++) {
                }

                // End the last row and the table
                echo "</tr></table>";
                ?>
            </div>
            </ul>
        </div>
    </div>
    </div>
    </div>
</body>

</html>