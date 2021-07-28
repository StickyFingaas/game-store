<?php
include('config.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$update = false;

$id = "";
$title = "";
$grade = "";
$desc = "";
$year = "";
$genre = "";
$platform = "";
$price = "";
$image = "";

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $grade = $_POST['grade'];
    $desc = $_POST['desc'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $platform = $_POST['platform'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $upload = "img/blog/" . $image;

    $query = "INSERT INTO game(title, grade, description, year, genre, platform, price, image)
        VALUES('$title', '$grade', '$desc', '$year', '$genre', '$platform', '$price', '$upload')";
    $result = $konekcija->query($query);
    move_uploaded_file($_FILES['image']['tmp_name'], $upload);
    header("Location: games.php");
    $_SESSION['response'] = "Successfully added to the database!";
    $_SESSION['res_type'] = "success";
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "select image from game where id = ?";
    $stmt2 = $konekcija->prepare($sql);
    $stmt2->bind_param("i", $id);
    $stmt2->execute();
    $result1 = $stmt2->get_result();
    $row = $result1->fetch_assoc();

    $imagepath = $row['image'];
    unlink($imagepath);

    $query = "delete from game where id = ?";
    $result = $konekcija->prepare($query);
    $result->bind_param("i", $id);
    $result->execute();
    header("Location: games.php");
    $_SESSION['response'] = "Successfully deleted from the database!";
    $_SESSION['res_type'] = "danger";
}
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = "select * from game where id = ?";
    $stmt = $konekcija->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $rezultat = $stmt->get_result();
    $row = $rezultat->fetch_assoc();

    $id = $row['id'];
    $title = $row['title'];
    $grade = $row['grade'];
    $desc = $row['description'];
    $year = $row['year'];
    $genre = $row['genre'];
    $platform = $row['platform'];
    $price = $row['price'];
    $image = $row['image'];
    $update = true;
}
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $grade = $_POST['grade'];
    $desc = $_POST['desc'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $platform = $_POST['platform'];
    $price = $_POST['price'];
    $oldImage = $_POST['oldimage'];

    if(isset($_FILES['image']['name'])&&($_FILES['image']['name']!="")){
        $newImage = "img/blog/". $_FILES['image']['name'];
        unlink($oldImage);
        move_uploaded_file($_FILES['image']['tmp_name'], $newImage);
    }else{
        $newImage = $oldImage;
    }
    $query = "UPDATE game set title=?, grade=?, description=?, year=?, genre=?, platform=?, price=?, image=? WHERE id=?";
    $stmt = $konekcija->prepare($query);
    $stmt->bind_param("sisissisi", $title, $grade, $desc, $year, $genre, $platform, $price, $newImage, $id);
    $stmt->execute();

    $_SESSION['response']="Updated Successfully!";
    $_SESSION['res_type']="primary";
    header("Location: games.php");
}
