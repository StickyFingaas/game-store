<?php
session_start();
    include ('config.php');
    if (isset($_SESSION['username'])) {
      header('Location: index.php');
  }
  
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE username='$username' ";
    $execute = $konekcija->query($query);

    if ($execute->num_rows > 0) {

        while ($row = $execute->fetch_assoc()) {
            if ($row['username'] == $username && $row['password'] == $password) {
                $_SESSION["username"] = $username;
                $_SESSION["password"] = $password;
                echo "<script>window.alert('DOBRO DOSLI ' + $username)</script>";
                header("Location:index.php");
            } else {
                echo "<script>window.alert('Lozinka nije u redu!')</script>";
            }
        }

    }else {
        echo "<script>window.alert('Korisnik nije pronadjen!')</script>";
    }
}

?>
<!DOCTYPE html>
<head>
<title>Login</title>
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
    <form class="login-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <input type="text" name="username" placeholder="username"/>
      <input type="password" name="password" placeholder="password"/>
      <button name="submit">login</button>
      <p class="message">Not registered? <a href="register.php">Create an account</a></p>
      <p class="message"><a href="forgotPass.php">Change your password</a></p>
    </form>
  </div>
</div></body>
</html>