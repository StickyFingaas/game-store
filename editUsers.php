<?php
    include ('config.php');
    session_start();
    $username = $email = $password = $nameSurname = "";
$nameErr = $emailErr = $pass1Err = $passErr = "";
$valid = true;



$id = $_GET['id'];

if (!empty($_POST['username'])) {
    $username = $_POST['username'];
    $nameErr = "";
} 
if (!empty($_POST['nameSurname'])) {
    $nameSurname = $_POST['nameSurname'];
    $nameErr = "";
} 

if (empty($_POST["email"])) {
    $emailErr = "Please enter new e-mail";
    $valid = false;
} else {
    $email = $_POST['email'];
    $emailErr = "";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      
        $valid = false;
    }
}

if (isset($_POST['password'])) {
    $password = $_POST['password'];

}
if ($valid) {
    if (!empty($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }

    $sql = "UPDATE users  set username = '$username', nameSurname = '$nameSurname', email = '$email', password ='$password' WHERE userID =$id ";
    $konekcija->query($sql);
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
    header('Location:users.php');
} else {
    $sql = "SELECT * FROM users where userID = $id";
    $get = $konekcija->query($sql);

    $data = $get->fetch_assoc();
    $username  = $data['username'];
    $password = $data['password'];
    $nameSurname = $data['nameSurname'];
    $email = $data['email'];
}

?>
<!DOCTYPE html>
<head>
<title>Update User</title>
<link rel="stylesheet" href="css/login.css"/>
<script>
$('.message a').click(function(){S
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
</script>
</head>
<body>
<div class="login-page">
  <div class="form">
    <form class="login-form" action="editUsers.php?id=<?php echo $id ?>" method="post">
        <p name="id"><?php echo $id?></p>
      <input type="text" name="username" placeholder="Username" value="<?php echo $username?>"/>
      <input type="text" name="password" placeholder="Password" value="<?php echo $password?>"/>
      <input type="text" name="nameSurname" placeholder="Name-Surname" value="<?php echo $nameSurname?>"/>
      <input type="text" name="email" placeholder="Email" value="<?php echo $email?>"/>
      <button name="submit">UPDATE</button>
      <p class="message">Changed your mind? <a href="users.php">Go back.</a></p>
    </form>
  </div>
</div></body>
</html>