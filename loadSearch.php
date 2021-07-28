<?php
include('config.php');
if (isset($_POST['query'])) {
	$inpText = $_POST['query'];
	$sql = "SELECT * FROM game WHERE title LIKE '%$inpText%'";
	$result = $konekcija->query($sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<a href='single-post.php?id=" . $row['id'] . "'
			 class='list-group-item list-group-item-action border-1'>". 
			 $row['title']."</a>";
		}
	} else {
		echo "<p class='list-group-item border-1'>No results.</p>";
	}
}
