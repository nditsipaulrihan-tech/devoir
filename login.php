<?php
session_start();

include("connection.php");

$error = []; $info = $pass =''; 

if($_SERVER['REQUEST_METHOD']=='POST'){
  $info     = isset($_POST['info']) ? trim($_POST['info']) : '';
    $pass = isset($_POST['zpassword']) ? $_POST['zpassword'] : '';

    if(!empty($info) && !empty($pass)){

      $sql = "SELECT * FROM user_info WHERE email='$info';";

      $result = mysqli_query($conn, $sql);
      if(!empty($result)){
        if($row = mysqli_fetch_assoc($result)){
        if(password_verify($pass, $row['password'])){
          $_SESSION['id']= $row['id'];
          $_SESSION['name']= $row['name'];
          $_SESSION['email']= $row['email'];
          $_SESSION['number']= $row['number'];

          header("Location: index.php");
          exit();
        }else{
          $error['info'] = "<center><span>Incorrect Password</span></center>";
        }}
      } else{
        $error['info'] = "<center><span>User Not Found</span></center>";
      }
      
      if(empty($error)){
        $error['info'] = '';
      }
      } else{
        $error['info'] = "<center><span>Input User Info</span></center>";
      }

  }

?>






<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Log In</title>
</head>
<body>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

    <h2>Log In</h2>

    <?php echo $error['info'];?>

    <div class="formg">
      <label for=""><b>Email:</b></label>
      <input type="email" class="input" name="info" placeholder="email or number">
    </div>

    <div class="formg">
      <label for=""><b>Password:</b></label>
      <input type="password"  class="input" name="zpassword" placeholder="Password" id="lshow" maxlength="20" minlength="6">
      <label for=""><input type="checkbox" name="" id="zshow">Show</label>
    </div>

    <button type="submit">Log In</button><br><br>
    <a href="signup.php">Sign Up</a>
  </form>

  <script src="script2.js"></script>
</body>
</html>