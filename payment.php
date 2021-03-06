<?php
session_start();
require 'connection.php';
$conn = Connect();
if(!isset($_SESSION['login_user'])){
header("location: customerlogin.php"); //Redirecting to myrestaurant Page
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>PlayEZ</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="./index.php">PlayEZ</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./aboutus.php">About Us</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./catalog.php">Catalog</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Consoles
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="./productpage.php?id=1037">PlayStation 5</a>
							<a class="dropdown-item" href="./productpage.php?id=1038">Xbox Series X</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="./productpage.php?id=1003">Playstation 4</a>
							<a class="dropdown-item" href="./productpage.php?id=1039">Xbox One</a>
							<a class="dropdown-item" href="./productpage.php?id=1041">Nintendo Switch</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="./productpage.php?id=1002">Playstation 3</a>
							<a class="dropdown-item" href="./productpage.php?id=1000">Xbox 360</a>
							<a class="dropdown-item" href="./productpage.php?id=1043">Nintendo Wii</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="./productpage.php?id=1042">Playstation 2</a>
							<a class="dropdown-item" href="./productpage.php?id=1001">Playstation</a>
							<a class="dropdown-item" href="./productpage.php?id=1040">Xbox</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Accessories
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">PlayStation Accessories</a>
							<a class="dropdown-item" href="#">Xbox Accessories</a>
							<a class="dropdown-item" href="#">Nintendo Accessories</a>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./contactus.php">Contact Us <span class="sr-only">(current)</span></a>
					</li>
				</ul>
				<?php
				if (isset($_SESSION['login_user'])) {
					?>
					<ul class="navbar-nav navbar-right">
						<li><a href="#"><span class="fa fa-user"></span> Welcome <?php echo $_SESSION['login_user']; ?> </a></li>
						<li><a href="cart.php"><span class="fa fa-shopping-cart"></span> Cart
							(<?php
								if(isset($_SESSION["cart"])){
									$count = count($_SESSION["cart"]); 
									echo "$count"; 
								}
								else
									echo "0";
								?>)
							</a></li>
							<li><a href="logout_u.php"><span class="fa fa-log-out"></span> Log Out </a></li>
						</ul>
				<?php        
				}
				else {
						?>
					<a class="text-white" href="./customerlogin.php">
						<span class="fa fa-sign-in"></span>Login
					</a>
				<?php
				}
				?>
			</div>
		</div>
	</nav>



	<?php
	$gtotal = 0;
	foreach($_SESSION["cart"] as $keys => $values)
	{

		$P_ID = $values["Product_id"];
		$prodname = $values["pro_name"];
		$quantity = 1;
		$price =  $values["price"];
		$total = $values["price"];
		$username = $_SESSION["login_user"];
		$order_date = date('Y-m-d');
		
		$gtotal = $gtotal + $total;

	}
	?>

	<header class="jumbotron">
        <div class="container">
            <div class="row row-header">
                <div class="col-12 col-sm-6">
                    <h1 class="text-center">Payment</h1>
					<p class="text-center">Choose your payment option</p>
                </div>
            </div>
        </div>
    </header>
	<br>
	<h1 class="text-center">Grand Total: &#8377;<?php echo "$gtotal"; ?>/-</h1>
	<h5 class="text-center">including all service charges. (no delivery charges applied)</h5>
	<br>
	<h1 class="text-center">
		<a href="cart.php"><button class="btn btn-warning"><span class="fa fa-circle-arrow-left"></span> Go back to cart</button></a>
		<a href="onlinepay.php?order=<?php echo "$gtotal"; ?>"><button class="btn btn-success"><span class="fa fa-credit-card"></span> Pay Online</button></a>
		<a href="COD.php"><button class="btn btn-success"><span class="fa fa-"></span> Cash On Delivery</button></a>
	</h1>
	


	<br><br><br><br><br><br>
		<footer class="footer bg-dark">
			<div class="container">
				<div class="row">             
					<div class="col-4 offset-1 col-sm-2">
						<h5>Links</h5>
						<ul class="list-unstyled">
							<li><a href="./index.php">Home</a></li>
							<li><a href="./aboutus.php">About</a></li>
							<li><a href="./catalog.php">Catalog</a></li>
							<li><a href="./contactus.php">Contact</a></li>
						</ul>
					</div>
					<div class="col-7 col-sm-5">
						<h5>Our Address</h5>
						<address>
							625 2nd Street, <br>
							4th Floor, MG Road, <br>
							Bangalore, India<br>
							<i class="fa fa-phone fa-lg"></i> : +91 98765 56789<br>
							<i class="fa fa-fax fa-lg"></i> : +91 87654 43210<br>
							<i class="fa fa-envelope fa-lg"></i> : <a href="mailto:pogchamp@playez.net">pogchamp@playez.net</a>
						</address>
					</div>
					<div class="col-12 col-sm-4 align-self-center">
						<div class="text-center">
							<a class="btn btn-social-icon btn-google" href="http://google.com/"><i class="fab fa-google fa-lg"></i></a>
							<a class="btn btn-social-icon btn-facebook" href="http://www.facebook.com/profile.php?id="><i class="fab fa-facebook fa-lg"></i></a>
							<a class="btn btn-social-icon btn-linkedin" href="http://www.linkedin.com/in/"><i class="fab fa-linkedin fa-lg"></i></a>
							<a class="btn btn-social-icon btn-twitter" href="http://twitter.com/"><i class="fab fa-twitter fa-lg"></i></a>
							<a class="btn btn-social-icon btn-google" href="http://youtube.com/"><i class="fab fa-youtube fa-lg"></i></a>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">             
					<div class="col-auto">
						<p>© Copyright 2020 PlayEZ</p>
					</div>
				</div>
			</div>
		</footer>


	<script src="js/jquery.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/scripts.js"></script>
</body>
</html>