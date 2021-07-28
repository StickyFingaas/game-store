<?php
include('config.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$username = $_SESSION['username'];

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "delete from purchase where id = $id";
    $result = $konekcija->query($sql);
    header("Location: cart.php");
    $_SESSION['response'] = "Cart item deleted!";
    $_SESSION['res_type'] = "danger";
}
if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $sql = "delete from purchase where username = '$name'";
    $result = $konekcija->query($sql);
    header("Location:cart.php");
    $_SESSION['response'] = "Successful purchase!";
    $_SESSION['res_type'] = "success";
}
