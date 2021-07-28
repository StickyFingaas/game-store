<?php
session_start();
    include ('config.php');
    if (isset($_SESSION['username'])) {
      header('Location: index.php');
    }
  $id = $_GET['id'];
  $user = $oldPass = $newPass = "";
  $sql = "select * from users where userID = '" . $id . "'";
  $exec = $konekcija->query($sql);
  $row = mysqli_fetch_assoc($exec);
      $user = $row['username'];
      $oldPass = $row['password'];
      if(isset($_POST['submit'])){
        if(!empty($_POST['newPass'])){
          $newPass = $_POST['newPass'];
          if($newPass!=$oldPass){
            $sql1 = "update users set password = '". $newPass . "' where userID = '". $row['userID'] . "'";
            $result = $konekcija->query($sql1);
             echo "<script>window.alert('Successful update!')</script>";
              header("Location: login.php");
          }else{
              echo "<script>window.alert('Password must be different!')</script>";
            }
        }else{
          echo "<script>window.alert('New password must not be empty!')</script>";
        }
      }
  
?>
<!DOCTYPE html>
<head>
<title>Change Password</title>
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
    <form class="login-form" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id?>" method="POST">
    <p>Create new password</p>
      <input type="text" name="username" placeholder="username" value="<?php echo $user?>"/>
      <input type="text" name="oldPass" placeholder="old password" value="<?php echo $oldPass?>"/>
      <input type="text" name="newPass" placeholder="new password" value="<?php echo $newPass?>"/>
      <button name="submit">SAVE</button>
    </form>
    <p class="message">Changed your mind? <a href="login.php">Go back here!</a></p>
  </div>
</div></body>
</html>