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
						<a href="index.php">Home</a>
						<?php if (!isset($_COOKIE['email'])): ?>
				<?php else: ?>
					<li>
						<a>Welcome, <?php echo $_COOKIE['type'] . '  ' . $_COOKIE['email'] . '' ?></a>
					</li>
					<li><a href="logout.php">Logout</a></li>
					<?php endif ?>
					</li>
					<!-- php section -->

					<div id="login_form">

						<?php
						$hostname = "localhost";
						$database = "Shopee";
						$db_login = "root";
						$db_pass = "";

						$dlink = mysql_connect($hostname, $db_login, $db_pass) or die("Could not connect");
						mysql_select_db($database) or die("Could not select database");

						// Register
						
						if ($_REQUEST['name'] != "" && $_REQUEST['email'] != "" && $_REQUEST['password'] != "" && $_REQUEST['contact'] != "" && $_REQUEST['address'] != "") {
							$query = "SELECT * FROM user WHERE email='" . $_REQUEST['email'] . "'";
							$result = mysql_query($query) or die(mysql_error());
							$num_results = mysql_num_rows($result);
						
							if ($num_results == 0) {
								// Check if this is the first registered user
								$query = "SELECT * FROM user";
								$result = mysql_query($query) or die(mysql_error());
								$num_results = mysql_num_rows($result);
								
								$user_type = 'customer';
								
								if ($num_results == 0) {
									// First registered user is admin
									$user_type = 'admin';
								}
								
								$query = "INSERT INTO user(email, paswrd, contact, custname, address, usertype, user_date, user_ip) VALUES('" . $_REQUEST['email'] . "', '" . $_REQUEST['password'] . "', '" . $_REQUEST['contact'] . "', '" . $_REQUEST['name'] . "' ,'" . $_REQUEST['address'] . "', '" . $user_type . "', '" . date("Y-m-d h:i:s") . "', '" . $_SERVER['REMOTE_ADDR'] . "')";
								$result = mysql_query($query) or die(mysql_error());
								echo "<meta http-equiv='refresh' content='0;url=index.php?action=login&#login_form'>";
							} else {
								echo "<meta http-equiv='refresh' content='0;url=index.php?registered=user&register=true&#register'>";
								echo '<script>alert("Account Already Registered")</script>';
							}
						}
						

						// End of Register
						
						// Login
						
						if ($_REQUEST['logging_in'] == true) {
							$query = "select * from user where email='" . $_REQUEST['email'] . "' and paswrd='" . $_REQUEST['password'] . "'";
							$result = mysql_query($query) or die(mysql_error());
							$total_results = mysql_num_rows($result);
							if ($total_results == 0) {
								echo '<meta http-equiv="refresh" content="0;url=index.php?action=register&#login_form">';
							} else {
								$row = mysql_fetch_array($result);
								setcookie("email", $row['email'], time()+3600);
								setcookie("type", $row['usertype'], time()+3600);
								echo '<meta http-equiv="refresh" content="0,url=index.php?user=logged_in">';
							}
						}

						// End of Login
						
						// Register Form
						
						if ($_REQUEST['action'] == 'register') {
							print('<h1>Registration Form</h1>');
							print('<form action=index.php method=post>');
							print('Enter Name<input type=text name=name><br>');
							print('Enter Email<input type=text name=email><br>');
							print('Enter Password<input type=text name=password><br>');
							print('Enter Contact<input type=text name=contact><br>');
							print('Enter Address<input type=text name=address><br>');
							print('<input type=submit value=submit>');
							print('</form>');
						}

						// End of Register Form
						
						// Login Form
						
						if ($_REQUEST['action'] == 'login') {
							print('<h1 id="login">Login</h1>');
							print('<form action=index.php?logging_in=true method=post>');
							print('Enter Email<input type=text name=email><br>');
							print("Enter Password<input type=text name=password><br>");
							print('<input type=submit value=submit name=submit>');
							print('</form>');
						}

						// End of Login Form
						?>
						<?php
						if ($_REQUEST['user'] != "logged_in") {
							echo '<li class="nav-item"><a class="nav-link" href="index.php?action=login&#login_form">Login</a></li>';
							echo '<li class="nav-item"> <a class="nav-link" href="index.php?action=register&#login_form">Register</a></li>';
						} else if ($_REQUEST['user'] == "logged_in") {
						}
						?>
					</div>

					<!-- end php section -->

					<li>
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
					<li>
						<a href="calendar.php">Calendar</a>
					</li>
				</ul>
			</div>
			<div id="body">
				<div id="figure">
					<img src="images/headline-home.jpg" alt="Image">
					<span id="home">Maecenas pharetra hendrerit eros sed laoreet. <a href="index.html">Find out
							why.</a></span>
				</div>
				<div id="featured">
					<span class="whatshot"><a href="menu.html">Find out more</a></span>
					<div>
						<a href="menu.html"><img src="images/coffee1.jpg" alt="Image"></a>
						<a href="menu.html"><img src="images/coffee2.jpg" alt="Image"></a>
						<a href="menu.html"><img src="images/coffee3.jpg" alt="Image"></a>
					</div>
				</div>
				<div class="section">
					<ul>
						<li>
							<a href="blog.html"><img src="images/coffee-ingredients.jpg" alt="Image"></a>
							<h2><a href="blog.html">Lorem ipsum</a></h2>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in tellus id eros
								iaculis porttitor eget ultrices mauris. Nulla sodales congue ante, id
							</p>
							<a href="blog.html" class="readmore">Read More</a>
						</li>
						<li>
							<a href="blog.html"><img src="images/black-coffee.jpg" alt="Image"></a>
							<h2><a href="blog.html">Dolor sit amet</a></h2>
							<p>
								Nulla sodales congue ante, id fermentum mi tincidunt ac. Sed eu vestibulum nisl.
								Maecenas pharetra hendrerit eros sed laoreet. Maecenas malesuada
							</p>
							<a href="blog.html" class="readmore">Read More</a>
						</li>
						<li>
							<a href="blog.html"><img src="images/chocolate.jpg" alt="Image"></a>
							<h2><a href="blog.html">Nullam quis</a></h2>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in tellus id eros
								iaculis porttitor eget ultrices mauris. Nulla sodales congue ante, id
							</p>
							<a href="blog.html" class="readmore">Read More</a>
						</li>
					</ul>
					<div>
						<ul>
							<li>
								<h3><a href="blog.html">Lorem ipsum</a></h3>
								<span>28 November 2011</span>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. blandit nunc. Donec in
									velit sed ante interdum condimentum pretium sit amet erat.
								</p>
								<a href="blog.html" class="readmore">Read more</a>
							</li>
							<li>
								<h3><a href="blog.html">Dolor sit amet</a></h3>
								<span>25 November 2011</span>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit.
								</p>
								<a href="blog.html" class="readmore">Read more</a>
							</li>
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
						<li class="current">
							<a href="index.html">Home</a>
						</li>
						<li>
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