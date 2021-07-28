<?php
session_start();
include ('config.php');
$user = $_SESSION["username"];

$id = $_GET['id'];
$upit = "select distinct * from game where id = '" . $id . "'";
$result1 = $konekcija->query($upit);
$row1 = mysqli_fetch_assoc($result1);
$query = "select * from purchase where gameTitle = '" . $row1['title'] . "' and username = '" . $user . "'";
$rezultat = $konekcija->query($query);
if($rezultat->num_rows < 1){
    $upit1 = "insert into purchase (username,  gameTitle, price) values 
    ('" . $_SESSION['username'] ."', '" . $row1['title'] . "', '" .  $row1['price'] ."')";
    $result2 = $konekcija->query($upit1);
    header('Location: index.php');
    echo "<script>alert('Successfully added to cart!')</script>";
    exit();
}else{
    echo "<script>alert('You already have this item in cart!')</script>";
    header('Location: index.php');
    exit();
}

?>