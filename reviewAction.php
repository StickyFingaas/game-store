<?php
include('config.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$update = false;
$id = "";
$review = "";
$reviewID = "";
if (isset($_POST['add'])) {
    $id = $_POST['id'];
    if (!empty($_POST['review'])) {
        $user = $_SESSION['username'];
        $sql = "select * from game where id = $id";
        $result = $konekcija->query($sql);
        $row = $result->fetch_assoc();

        $title = $row['title'];
        $sql1 = "insert into review (username, gameTitle, review) values ('"
            . $user . "', '" . $title . "', '" . $_POST['review'] . "')";
        $result1 = $konekcija->query($sql1);
        header("Location: single-post.php?id=" . $id);
        $_SESSION['response'] = "Review successfully added!";
        $_SESSION['res_type'] = "success";
    } else {
        header("Location: single-post.php?id=$id");
        $_SESSION['response'] = "You cannot add an empty review!";
        $_SESSION['res_type'] = "danger";
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "select * from review where id = $id";
    $result1 = $konekcija->query($sql);
    $row1 = $result1->fetch_assoc();
    $title = $row1['gameTitle'];

    $upit = "select * from game where title = ?";
    $stmt = $konekcija->prepare($upit);
    $stmt->bind_param("s", $title);
    $stmt->execute();
    $rezultat = $stmt->get_result();
    $row = $rezultat->fetch_assoc();
    $ajdi = $row['id'];

    $query = "delete from review where id = ?";
    $result = $konekcija->prepare($query);
    $result->bind_param("i", $id);
    $result->execute();

    header("Location: single-post.php?id=$ajdi");
    $_SESSION['response'] = "Review successfully deleted!";
    $_SESSION['res_type'] = "danger";
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = "select * from review where id = ?";
    $stmt = $konekcija->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $rezultat = $stmt->get_result();
    $row = $rezultat->fetch_assoc();
    $title = $row['gameTitle'];

    $upit = "select * from game where title = ?";
    $stmt = $konekcija->prepare($upit);
    $stmt->bind_param("s", $title);
    $stmt->execute();
    $rezultat = $stmt->get_result();
    $row1 = $rezultat->fetch_assoc();
    $review = $row['review'];
    $update = true;
}

if(isset($_POST['update'])){
    $reviewID = $_POST['reviewID'];
    $review = $_POST['review'];

    $query = "select * from review where id = $reviewID";
    $result1 = $konekcija->query($query);
    $row = $result1->fetch_assoc();
    $title = $row['gameTitle'];
    $author = $row['username'];

    $upit = "select * from game where title = ?";
    $stmt = $konekcija->prepare($upit);
    $stmt->bind_param("s", $title);
    $stmt->execute();
    $rezultat = $stmt->get_result();
    $row1 = $rezultat->fetch_assoc();
    $ajdi = $row1['id'];

    if($_SESSION['username'] == 'admin'){
        $sql = "update review set review = ? where id = ?;";
    $stmt1 = $konekcija->prepare($sql);
    $stmt1->bind_param("si", $review, $reviewID);
    $stmt1->execute();
    // echo $id; echo $review; echo $ajdi;
    $_SESSION['response']="Review Updated Successfully!";
    $_SESSION['res_type']="primary";
    header("Location: single-post.php?id=$ajdi");
    }
    $sql = "update review set review = ? where id = ?;";
    $stmt1 = $konekcija->prepare($sql);
    $stmt1->bind_param("si", $review, $reviewID);
    $stmt1->execute();
    // echo $id; echo $review; echo $ajdi;
    $_SESSION['response']="Review Updated Successfully!";
    $_SESSION['res_type']="primary";
    header("Location: single-post.php?id=$ajdi");

}
