<?php
session_start();
include('config.php');
include('reviewAction.php');
if (!isset($_SESSION["username"])) {
	header("Location: login.php");
}
$user = $_SESSION["username"];

$id = $_GET['id'];
$sql = "select * from game where id = '" . $id . "'";
$result = $konekcija->query($sql);
$row = mysqli_fetch_assoc($result);
$title = $row['title'];
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>TheQuest - Gaming Magazine Template</title>
	<meta charset="UTF-8">
	<meta name="description" content="TheQuest Gaming Magazine Template">
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
	<link rel="stylesheet" href="css/slicknav.min.css" />

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="css/style.css" />

	<style>
		.table-hover tbody tr:hover td,
		.table-hover tbody tr:hover th {
			background-color: whitesmoke;
		}
	</style>

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

	<!-- Page top section -->
	<section class="page-top-section set-bg" data-setbg="<?php echo $row['image'] ?>">
		<div class="container">
			<h2><?php echo $row['title'] ?></h2>
		</div>
	</section>
	<!-- Page top section end -->

	<!-- Blog section -->
	<section class="blog-section spad">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-md-10" style="margin-top: -75px">
					<h3 class="text-center text-light">Manage Cart and Reviews</h3>
					<hr style="border-top: 1px solid whitesmoke; width: 100%;">
					<?php if (isset($_SESSION['response'])) { ?>
						<div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<b><?= $_SESSION['response']; ?></b>
						</div>
					<?php }
					unset($_SESSION['response']); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4" style="margin-top: -70px">
					<div class="blog-post mt-5 ml-5">
						<?php
						$sql = "select * from game where id = $id";
						$result = $konekcija->query($sql);
						$row = mysqli_fetch_assoc($result); ?>
						<div class="post-date"><?php echo $row['grade'] ?></div>
						<img src="<?php echo $row['image'] ?>" width="100" class="img-thumbnail">
						<h3><?php echo $row['title'] ?></h3>
						<div class="post-metas">
							<div class="post-meta">Year: <?php echo $row['year'] ?></div>
							<div class="post-meta">Genre: <?php echo $row['genre'] ?></div>
							<div class="post-meta">Platform: <?php echo $row['platform'] ?></div>
							<div class="post-meta">Price: <?php echo $row['price'] ?> $</div>
						</div>
						<p><?php echo $row['description'] ?></p>
						<div class="form-group">
							<form action="<?php echo 'addCart.php?id=' . $id; ?>" method="post">
								<input type='submit' class='btn btn-primary btn-block' value='Add to cart'>; </form>

						</div>
					</div>
				</div>
				<div class="col-md-8 m-0">
					<h4 class="text-center text-info mb-3">All reviews for <?php echo $row['title'] ?></h4>
					<table name="tabela" class="table table-hover" style="color:whitesmoke; ">
						<thead>
							<tr>
								<th>#</th>
								<th>User</th>
								<th>Review</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sql = "SELECT * FROM review where gameTitle = '" . $row['title'] . "'";
							$result = $konekcija->query($sql);
							$reviewID = "";
							while ($row = mysqli_fetch_assoc($result)) {
								$reviewID = $row['id'];
								$author = $row['username'];
								$sql1 = "select * from game where title =  '" . $row['gameTitle'] . "'";
								$result1 = $konekcija->query($sql1);
								while ($row1 = mysqli_fetch_assoc($result1)) {
									if (isset($_POST['delete'])) {
										$sql2 = "delete from review where id ='" . $reviewID  . "'";
										$result2 = $konekcija->query($sql2);
										header("Location: " . $_SERVER['REQUEST_URI']);
										exit();
									}
									echo "<tr>
									<td>" . $row['id'] . "</td>
									<td>" . $row['username'] . "</td>
									<td>" . $row['review'] . "</td>";
									if ($_SESSION['username'] == $author || $_SESSION['username'] == 'admin') {
										echo "<td><a href='single-post.php?id=" . $row1['id'] . "&edit=" . $row['id'] . "'class='badge badge-success p-2' >Edit</a> |" ?>
										<a href="reviewAction.php?delete=<?= $row['id']; ?>" class="badge badge-danger p-2" onclick="return confirm('Are you sure you want to delete this?');">Delete</a></td>
							<?php echo "</tr>";
									} else {
										echo "<td>*unavailable*</td>";
									}
								}
							} ?>
						</tbody>
					</table>
				</div>
			</div>


		</div>
		<div class="col-md-4 ml-5" style="margin-top: -50px">
			<h5 class="text-left text-info mb-3 ">Write a review</h5>
			<div class="form-group">
				<form class="comment-form" action="reviewAction.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="reviewID" value="<?= $_GET['edit']; ?>">
					<input type="hidden" name="id" value="<?= $id; ?>">

					<input type="hidden" name="username" value="<?= $_SESSION['username'] ?>">
					<input type="text" name="review" value="<?= $review; ?>" placeholder="Your review">
					<?php if ($update == true) { ?>
						<input type="submit" class="btn btn-success btn-block" name="update" value="Update review">
					<?php } else { ?>
						<input type="submit" class="btn btn-primary btn-block" name="add" value="Post review">
					<?php } ?>
				</form>
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
						<h2 class="fw-title">Usfull Links</h2>
						<ul>
							<li><a href="">Games</a></li>
							<li><a href="">testimonials</a></li>
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
						<h2 class="fw-title">Usfull Links</h2>
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
			<div class="copyright">
				<p>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;<script>
						document.write(new Date().getFullYear());
					</script> All rights reserved | This template is made<i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">ALEKSA</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
			</div>
		</div>
		<div class="social-links-warp">
			<div class="container">
				<div class="social-links">
					<a href="#"><i class="fa fa-instagram"></i><span>instagram</span></a>
					<a href="#"><i class="fa fa-pinterest"></i><span>pinterest</span></a>
					<a href="#"><i class="fa fa-facebook"></i><span>facebook</span></a>
					<a href="#"><i class="fa fa-twitter"></i><span>twitter</span></a>
					<a href="#"><i class="fa fa-youtube"></i><span>youtube</span></a>
					<a href="#"><i class="fa fa-tumblr-square"></i><span>tumblr</span></a>
				</div>
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

</body>

</html>