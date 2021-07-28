<?php
include('config.php');
session_start();
$count = $_POST['count'];
$sql = "select * from game limit $count";
$result = $konekcija->query($sql);
while ($row = mysqli_fetch_assoc($result)) { ?>
    <p><?php echo $row['description']?></p>
<?php

}

?>