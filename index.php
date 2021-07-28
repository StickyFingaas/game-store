<?php
session_start();
include('config.php');
if (!isset($_SESSION["username"])) {
	header("Location: login.php");
}
$user = $_SESSION["username"];
if (isset($_POST['submit'])) {
	header("Location: addCart.php?id=" . $_POST['id']);
}
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

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>

<body>
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

	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<div class="hero-item set-bg" data-setbg="img/slider/hero.png">
				<div class="container">
					<div class="row">
						<div class="col-lg-10 offset-lg-1">
							<h2>Enter the Nexus</h2>
							<p>Where true gaming legends reside</p>
							<a href="about.php" class="site-btn">ABOUT US</a>
						</div>
					</div>
				</div>
			</div>
			<div class="hero-item set-bg" data-setbg="img/slider/hero1.jpg">
				<div class="container">
					<div class="row">
						<div class="col-lg-10 offset-lg-1">
							<h2>Enter the Nexus</h2>
							<p>Where true gaming legends reside</p>
							<a href="about.php" class="site-btn">ABOUT US</a>
						</div>
					</div>
				</div>
			</div>
			<div class="hero-item set-bg" data-setbg="img/slider/hero2.png">
				<div class="container">
					<div class="row">
						<div class="col-lg-10 offset-lg-1">
							<h2>Enter the Nexus</h2>
							<p>Where true gaming legends reside</p>
							<a href="about.php" class="site-btn">ABOUT US</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Blog section -->
	<section class="blog-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 blog-posts">
					<div class="blog-post featured-post">
						<h3 style="margin-top: -60px">Welcome to Game Store!</h3>
						<h4 style="margin-top: 20px; margin-bottom: -40px;">↓ Purchase and review your favorite games in no time! ↓</h3></br>
					</div>
					<div class="row" id="genre">
						<?php
						$sql = "SELECT * FROM game";
						$result = $konekcija->query($sql);
						while ($row = mysqli_fetch_assoc($result)) {
							$game = $row['title'];
							$price = $row['price'];
							$id = $row['id'];

						?>
							<div class="col-md-6">
								<div class="blog-post">
									<img src="<?php echo $row['image'] ?>">
									<div class="post-date"><?php echo $row['grade'] ?></div>
									<h4><?php echo $row['title'] ?></h4>
									<p><?php echo $row['description'] ?></p>
									<form class="comment-form" action="<?php echo 'addCart.php?id=' . $id; ?>" method="post">
										<button name="submit" class="read-more" style="margin-right: 150px;">Add to Cart</button>
										<?php echo "<a href='single-post.php?id=" . $row['id'] . "' class='read-more'>View Details</a>" ?>
									</form>

									<div class="post-metas" style="margin-top: 10px">
										<div class="post-meta">Year: </br> <?php echo $row['year'] ?></div>
										<div class="post-meta">Genre: </br> <?php echo $row['genre'] ?></div>
										<div class="post-meta">Platform: </br> <?php echo $row['platform'] ?></div>
										<div class="post-meta">Price: </br> <?php echo $row['price'] ?> $</div>
									</div>
								</div>
							</div>
						<?php }

						?>

					</div>

				</div>


				<div class="col-lg-4 sidebar">
					<div class="sb-widget">
						<form action="loadSearch.php" method="post" class="sb-search" style="margin-top: -25px; margin-bottom: 10px;">
							<input type="text" name="search" id="search" placeholder="Search by game title" >
						</form>
					</div>
					<div class="col-md-5" style="position: relative; margin-top: -52px; margin-left: -15px; margin-bottom: 30px">
						<div class="list-group" id="show-list">
						</div>
					</div>

					<div class="sb-widget">
						<h2 class="sb-title">Select by genre</h2>
						<ul class="sb-cata-list">
							<li><a style="color: white; cursor: pointer" id="btnAll" style="color:white">All</a></li>
							<?php
							$sql = "select distinct genre, count(*) as c from game group by genre asc";
							$result = $konekcija->query($sql);
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<li><a href='' class='btnGnr' name='genre' style='color:white' data='" . $row['genre'] . "'>" . $row['genre'] . "<span>"
									. $row['c'] . "</span></a></li>";
							}
							?>
						</ul>
					</div>
					<div class="sb-widget">
						<h2 class="sb-title">Select by year</h2>
						<ul class="sb-cata-list">
							<?php
							$sql = "select distinct year, count(*) as c from game group by year desc";
							$result = $konekcija->query($sql);
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<li><a href='' class='btnYr' name='year' style='color:white' data='" . $row['year'] . "'>" . $row['year'] . "<span>"
									. $row['c'] . "</span></a></li>";
							}
							?>
						</ul>
					</div>
					<div class="sb-widget">
						<h2 class="sb-title">Select by platform</h2>
						<ul class="sb-cata-list">
							<?php
							$sql = "select distinct platform, count(*) as c from game group by platform asc";
							$result = $konekcija->query($sql);
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<li><a href='' class='btnPl' name='year' style='color:white' data='" . $row['platform'] . "'>" . $row['platform'] . "<span>"
									. $row['c'] . "</span></a></li>";
							}
							?>
						</ul>
					</div>
					<div class="sb-widget">
						<h2 class="sb-title">Latest Reviews</h2>
						<div class="latest-news-widget">
							<div class="ln-item">
								<?php $sql = 'SELECT * from review ORDER BY id desc LIMIT 3';
								$result = $konekcija->query($sql);
								while ($row = mysqli_fetch_assoc($result)) {
									$sql1 = "select * from game where title = '" . $row['gameTitle'] . "'";
									$result1 = $konekcija->query($sql1);
									while ($row1 = mysqli_fetch_assoc($result1)) {
								?>
										<img src=<?php echo $row1['image'] ?> alt="">
										<div class="ln-text" style="margin-bottom: 10px">
											<div class="ln-date"><?php echo $row1['grade'] ?></div>
											<h6><?php echo "<a href='single-post.php?id=" . $row1['id'] . "' class='read-more'>" . $row1['title'] . "</a>" ?></h6>
											<div class="ln-metas">
											<div class="ln-meta">By <?php echo $row['username'] ?></div>

											</div>
										</div>
								<?php
									}
								} ?>
							</div>

						</div>
					</div>
					<div class="sb-widget">
						<a href="#" class="add">
							<img src="img/add-2.jpg" alt="">
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Blog section end -->


	<!-- Video section -->
	<div class="video-section">
		<div class="container">
			<div class="video-logo">
				<img src="img/goty.jpg" alt="">
				<h3 style="margin-top: 25px; margin-bottom: -5px; color: whitesmoke;">Game of the Year</h3>
			</div>
			<div class="video-popup-warp">
				<img src="img/sekiro.jpg" alt="">
				<a href="https://www.youtube.com/watch?v=rXMX4YJ7Lks" class="video-play"><i class="fa fa-play"></i></a>
			</div>
		</div>
	</div>
	<!-- Video section end -->

	<!-- Footer section -->
	<div class="footer-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="footer-widget">
						<div class="about-widget">
							<!-- <img src="img/logo.png" alt=""> -->
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
	<script src="js/fetchGn.js"></script>

	<script>
		$(document).ready(function() {
			$("#search").keyup(function() {
				var searchText = $(this).val();
				if (searchText != '') {
					$.ajax({
						url: 'loadSearch.php',
						method: 'post',
						data: {
							query: searchText
						},
						success: function(response) {
							$("#show-list").html(response);
						}
					})
				} else {
					$("#show-list").html('');
				}
			});
			$(document).on('click', 'a', function() {
				$("#search").val($(this).text());
				$("#show-list").html('');
			});
		});

		$(document).ready(function() {

			$(document).on('click', ".btnGnr", function(e) {
				e.preventDefault();
				var genre = $(this).attr('data');
				$.ajax({
						url: 'loadGameByGenre.php',
						type: 'POST',
						data: {
							'query': genre
						}
					})
					.done(function(response) {
						$("#genre").html(response);

						console.log(response);
					})
			});

		});

		$(document).ready(function() {

			$(document).on('click', ".btnYr", function(e) {
				e.preventDefault();
				var year = $(this).attr('data');
				$.ajax({
						url: 'loadGameByYear.php',
						type: 'POST',
						data: {
							'query': year
						}
					})
					.done(function(response) {
						$("#genre").html(response);

						console.log(response);
					})
			});

		});

		$(document).ready(function() {

			$(document).on('click', ".btnPl", function(e) {
				e.preventDefault();
				var plat = $(this).attr('data');
				$.ajax({
						url: 'loadByPlatform.php',
						type: 'POST',
						data: {
							'query': plat
						}
					})
					.done(function(response) {
						$("#genre").html(response);

						console.log(response);
					})
			});

		});
	</script>

</body>

</html>