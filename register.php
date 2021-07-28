<?php
session_start();
    include ('config.php');
    $name = $user = $email = $pass ="";
    $nameErr = $passErr = $userErr = $emailErr ="";
    $valid = true;
    
    if (isset($_POST['submit'])) {
      
        if (empty($_POST['username'])) {
            $userErr = 'Please enter your username';
            $valid = false;
    
        } else {
            $user = $_POST['username'];
            $valid = true;
        }
        if (empty($_POST['name'])) {
          $nameErr = 'Please enter your name';
          $valid = false;
      } else {
          $name = $_POST['name'];
          $valid = true;
      }
        if (empty($_POST['email'])) {
            $emailErr = "Please enter your e-mail";
            $valid=false;
        } else {
            $email = $_POST['email'];
            $valid=true;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                $valid=false;
            }
    
        }
    
    
        if (isset($_POST['pass'])) {
            $pass = $_POST['pass'];
            if (strlen($pass) < '8' || !preg_match("#[0-9]+#", $pass)) {
                $passErr = "8 or more letters and at least one number!";
                $valid = false;
            }
    
        } else {
            $passErr = 'Please enter your password';
            $valid = false;
        }
    
    
    
        if($valid){
    
            $checkSql = "SELECT * FROM users WHERE username = '$user'";
            $execute = $konekcija->query($checkSql);
    
            if ($execute->num_rows > 0) {
                echo "<script>alert('Korisnik sa tim imenom vec postoji!')</script>";
            } else {
                $sql = "INSERT INTO users (nameSurname, username, email, password) values ('$name', '$user', '$email', '$pass') ;";
                if($konekcija -> query($sql)){
                    header("Location:login.php");
                } else {
                    die("Greska " . $konekcija->error);
                }
            }
    
        }
    }

?>
<!DOCTYPE html>
<head>
<title>Register</title>
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
    <form style="margin: 0 auto" class="login-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <h2>Registration</h2>
      <input type="text" name="username" placeholder="username (*)" value="<?php echo $user;?>"/>
      </br><span name="userErr" style="color: red"><?php  echo $userErr ?></span></br>
      <input type="text" name="name" placeholder="name/surname" value="<?php echo $name;?>"/>
      </br><span name="nameErr" style="color: red"><?php  echo $nameErr ?></span></br>
      <input type="text" name="email" placeholder="email (*)" value="<?php echo $email;?>"/>
      </br><span name="mailErr" style="color: red"><?php  echo $emailErr ?></span></br>
      <input type="password" name="pass" placeholder="password (*)" value="<?php echo $pass;?>"/>
      </br><span name="passErr" style="color: red"><?php  echo $passErr ?></span></br>
      <button name="submit">Register</button>
      <p class="message">Already registered? <a href="login.php">Log in here!</a></p>
    </form>
  </div>
</div></body>
</html>