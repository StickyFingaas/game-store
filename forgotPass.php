<?php
session_start();
include('config.php');
if (isset($_SESSION['username'])) {
  header('Location: index.php');
}

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  if ($username != "" && $password != "") {
    $query = "select * from users where username ='" . $username . "' and password = '" . $password . "'";
    $execute = $konekcija->query($query);
    if ($execute->num_rows > 0) {

      while ($row = $execute->fetch_assoc()) {
        if ($row['username'] == $username) {
          header('Location:forgotPass1.php?id=' . $row['userID']);
        }
      }
    }else{
      echo "<script>window.alert('User with existing data not found!')</script>";
    }
  }else {
    echo "<script>window.alert('User data not valid!')</script>";
  }
} 

?>
<!DOCTYPE html>

<head>
  <title>Change Password</title>
  <link rel="stylesheet" href="css/login.css" />
  <script>
    $('.message a').click(function() {
      S
      $('form').animate({
        height: "toggle",
        opacity: "toggle"
      }, "slow");
    });
  </script>
</head>

<body>
  <div class="login-page">
    <div class="form">
      <form class="login-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <p>Type in your details</p>
        <input type="text" name="username" placeholder="username" />
        <input type="pass" name="password" placeholder="password" />
        <button name="submit">Next</button>
      </form>
      <p class="message">Changed your mind? <a href="login.php">Go back here!</a></p>
    </div>
  </div>
</body>

</html>