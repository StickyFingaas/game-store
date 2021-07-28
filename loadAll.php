<?php

include('config.php');
session_start();
            			$sql = "SELECT * FROM game";
						$result = $konekcija->query($sql);						
            			while ($row = mysqli_fetch_assoc($result)) { 
							$game = $row['title'];
							$price = $row['price'];
							$id = $row['id'];
							
						?>
						<div class="col-md-6">
							<div class="blog-post">
								<img src="<?php echo $row['image']?>">
								<div class="post-date"><?php echo $row['grade']?></div>
								<h4><?php echo $row['title']?></h4>
								<p><?php echo $row['description']?></p>
								<form class="comment-form" action="<?php echo 'addCart.php?id=' . $id;?>" method="post">
								<button name="submit" class="read-more" style="margin-right: 150px;">Add to Cart</button>
										<?php echo "<a href='single-post.php?id=" . $row['id'] . "' class='read-more'>View Details</a>" ?>
								</form>
								
								<div class="post-metas" style="margin-top: 10px">
							<div class="post-meta">Year: </br> <?php echo $row['year']?></div>
							<div class="post-meta">Genre: </br> <?php echo $row['genre']?></div>
							<div class="post-meta">Platform: </br> <?php echo $row['platform']?></div>
							<div class="post-meta">Price: </br> <?php echo $row['price']?> $</div>
							</div>
							</div>
						</div>
						<?php }
						
						?>