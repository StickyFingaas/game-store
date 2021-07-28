<?php
session_start();
include('config.php');
if (!isset($_SESSION["username"])) {
	header("Location: login.php");
}
$user = $_SESSION["username"];

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>GameStore - Buy and Review Games</title>
	<meta charset="UTF-8">
	<meta name="description" content="GameStore - Buy and Review Games">
	<meta name="keywords" content="gaming, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon" />

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/magnific-popup.css" />
	<link rel="stylesheet" href="css/owl.carousel.min.css" />
	<link rel="stylesheet" href="css/animate.css" />
	<link rel="stylesheet" href="css/slicknav.min.css" />

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="css/style.css" />


	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
		.table-hover tbody tr:hover td,
		.table-hover tbody tr:hover th {
			background-color: whitesmoke;
		}

		.table>tbody>tr>td {
			vertical-align: middle;
		}
	</style>
</head>

<body style="width: 100%">
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section">
		<a href="index.php" class="site-logo">
			<img src="img/logo_files/logo.jpg" alt="logo">
		</a>
		<ul class="main-menu">
			<li><a href="index.php">Home</a></li>
			<li><a href="reviews.php">Reviews</a></li>
			<li><a href="cart.php">Cart</a></li>
			<?php if ($_SESSION['username'] == 'admin') {
				echo "<li><a href='games.php'>Games</a></li>";
			} ?>
			<li><a href="users.php">Users</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="logout.php">Logout</a></li>
			<li><a href="cart.php" style="font-style: italic; color: skyblue"><?php echo $user ?> <img src="img/profile.png" style="width: 30px; height: 30px ;border-radius:50%"></a> </li>
			<li></li>
		</ul>
		<a href="index.php">
			<img src="img/logo_files/logo.jpg" alt="logo">
		</a>
	</header>
	<!-- Header section end -->

	<section class="page-top-section set-bg" data-setbg="img/header-bg/2.jpg">
		<div class="container">
			<h2>Users</h2>
		</div>
	</section>

	<!-- Blog section -->
	<section class="blog-section spad">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-md-10" style="margin-top: -75px">
					<h3 class="text-center text-light">Manage Users</h3>
					<hr style="border-top: 1px solid whitesmoke; width: 100%;">
				</div>
				<div class="col-md-8">
					<h4 class="text-center text-info mb-3">Users in Database</h4>
					<table name="tabela" class="table table-hover" style="color:whitesmoke; ">
						<thead>
							<tr>
								<td>ID</td>
								<td>Name/Surname</td>
								<td>Username</td>
								<td>Email</td>
								<td>Password</td>
								<td>Action</td>
							</tr>
						</thead>
						<?php
						$sql = "select * from users";
						$result = $konekcija->query($sql);
						while ($row = mysqli_fetch_assoc($result)) {
						?>
							<tr>
								<td><?php echo $row['userID'] ?></td>
								<td><?php echo $row['nameSurname'] ?></td>
								<td><?php echo $row['username'] ?></td>
								<td><?php echo $row['email'] ?></td>
								<?php if ($_SESSION['username'] == $row['username'] || $_SESSION['username'] == 'admin') {
									echo "<td>" . $row['password'] . "</td>";
								}else {
									echo "<td>*unavailable*</td>";
								}
								 ?>
								<?php if ($_SESSION['username'] == $row['username']) {
									echo "<td><a href='editUsers.php?id=" . $row['userID'] . "' class='badge badge-primary p-2'>Edit</a></td>";
								 
								} 
								echo "<td></td>";
								?>

							</tr>
						<?php
						}
						?>
					</table>

				</div>
			</div>


		</div>
		</div>
	</section>
	<!-- Blog section end -->

	<!-- Footer section -->
	<div class="footer-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="footer-widget">
						<div class="about-widget">
							<img src="img/logo.png" alt="">
							<p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo. Morbi id dictum quam, ut commodo.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-sm-6">
					<div class="footer-widget">
						<h2 class="fw-title">Useful Links</h2>
						<ul>
							<li><a href="">Games</a></li>
							<li><a href="">Testimonials</a></li>
							<li><a href="">Reviews</a></li>
							<li><a href="">Characters</a></li>
							<li><a href="">Latest news</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-sm-6">
					<div class="footer-widget">
						<h2 class="fw-title">Services</h2>
						<ul>
							<li><a href="">About us</a></li>
							<li><a href="">Services</a></li>
							<li><a href="">Become a writer</a></li>
							<li><a href="">Jobs</a></li>
							<li><a href="">FAQ</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-sm-6">
					<div class="footer-widget">
						<h2 class="fw-title">Careeres</h2>
						<ul>
							<li><a href="">Donate</a></li>
							<li><a href="">Services</a></li>
							<li><a href="">Subscriptions</a></li>
							<li><a href="">Careers</a></li>
							<li><a href="">Our team</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget fw-latest-post">
						<h2 class="fw-title">Useful Links</h2>
						<div class="latest-news-widget">
							<div class="ln-item">
								<div class="ln-text">
									<div class="ln-date">April 1, 2019</div>
									<h6>10 Amazing new games</h6>
									<div class="ln-metas">
										<div class="ln-meta">By Admin</div>
										<div class="ln-meta">in <a href="#">Games</a></div>
										<div class="ln-meta">3 Comments</div>
									</div>
								</div>
							</div>
							<div class="ln-item">
								<div class="ln-text">
									<div class="ln-date">April 1, 2019</div>
									<h6>10 Amazing new games</h6>
									<div class="ln-metas">
										<div class="ln-meta">By Admin</div>
										<div class="ln-meta">in <a href="#">Games</a></div>
										<div class="ln-meta">3 Comments</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright"><a href="">
					<p>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>
							document.write(new Date().getFullYear());
						</script> All rights reserved | This template is made<i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">ALEKSA</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</p>
			</div>
		</div>
	</div>
	<!-- Footer section end -->

	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/circle-progress.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/fetchData.js"></script>

</body>

</html>