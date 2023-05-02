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
					<span>Lorem ipsum dolor sit amet.</span>
				</div>
				<div>
					<a href="#" class="whatshot"></a>
					<div>
						<ul>
							<li>
								<a href="#"><img src="images/coffee1.jpg" alt="Image"></a>
								<div>
									<a href="index.html">Lorem ipsum</a>
									<p>
										Lorem ipsum &#36;0.00
									</p>
								</div>
							</li>
							<li>
								<a href="#"><img src="images/coffee2.jpg" alt="Image"></a>
								<div>
									<a href="index.html">Dolor sit amet</a>
									<p>
										Lorem ipsum &#36;0.00
									</p>
								</div>
							</li>
							<li>
								<a href="#"><img src="images/coffee3.jpg" alt="Image"></a>
								<div>
									<a href="index.html">Donie quis</a>
									<p>
										Lorem ipsum &#36;0.00
									</p>
								</div>
							</li>
							<h1>Hot Brew</h1>
							<li>
								<a href="#"><img src="images/coffee4.jpg" alt="Image"></a>
								<div>
									<a href="index.html">Lorem ipsum</a>
									<p>
										Lorem ipsum &#36;0.00
									</p>
								</div>
							</li>
							<li>
								<a href="#"><img src="images/coffee5.jpg" alt="Image"></a>
								<div>
									<a href="index.html">Dolor sit amet</a>
									<p>
										Lorem ipsum &#36;0.00
									</p>
								</div>
							</li>
							<li>
								<a href="#"><img src="images/coffee6.jpg" alt="Image"></a>
								<div>
									<a href="index.html">Donie quis</a>
									<p>
										Lorem ipsum &#36;0.00
									</p>
								</div>
							</li>
							<h1>Cold Brew</h1>
							<li>
								<a href="#"><img src="images/coffee3.jpg" alt="Image"></a>
								<div>
									<a href="index.html">Lorem ipsum</a>
									<p>
										Lorem ipsum &#36;0.00
									</p>
								</div>
							</li>
							<li>
								<a href="#"><img src="images/coffee2.jpg" alt="Image"></a>
								<div>
									<a href="index.html">Dolor sit amet</a>
									<p>
										Lorem ipsum &#36;0.00
									</p>
								</div>
							</li>
							<li>
								<a href="#"><img src="images/coffee1.jpg" alt="Image"></a>
								<div>
									<a href="index.html">Donie quis</a>
									<p>
										Lorem ipsum &#36;0.00
									</p>
								</div>
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
						<a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" id="facebook">Facebook</a>
						<a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" id="twitter">Twitter</a>
						<a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" id="googleplus">Google+</a>
						<a href="index.html" id="rss">RSS</a>
					</div>
					<p>
						This website template has been designed by <a href="http://www.freewebsitetemplates.com/">Free Website Templates</a> for you, for free. You can replace all this text with your own text. You can remove any link to our website from this website template, you&#39;re free to use this website template without linking back to us. If you&#39;re having problems editing this website template, then don&#39;t hesitate to ask for help on the <a href="http://www.freewebsitetemplates.com/forums/">Forums</a>.
					</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>