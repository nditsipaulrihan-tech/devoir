<?php
session_start();

include("connection.php");

$info = $pass = $cpass = $hpass = $error = '';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $info = isset($_POST['info']) ? trim($_POST['info']) : '';
    $pass = isset($_POST['password']) ? $_POST['password'] : '';
    $cpass = isset($_POST['cpassword']) ? $_POST['cpassword'] : '';

    if(!empty($info)){
      
      $sql = "SELECT * FROM user_info WHERE email='$info';";
      $result = mysqli_query($conn, $sql);
      
      if(mysqli_fetch_row($result) > 0){
       if(!empty($pass)){
        if(strlen($pass)<6 || strlen($pass)>10){
        $error = "<center><span>Password must be between 6-10 characters</span></center>";
      } elseif (empty($cpass)){
        $error = "<center><span>Confirm Password</span></center>";
      } elseif ($cpass !== $pass){
        $error = "<center><span>Incorrect Password</span></center>";
      } else{
        $hpass = password_hash($pass, PASSWORD_BCRYPT);
        $sqli = "UPDATE user_info SET password='$hpass' WHERE email='$info';";
        mysqli_close($conn);
        $_SESSION['update'] = "<script>alert('Password Updated');</script>";
        header("Location: login.php");
        exit();
      }
       } else{
        $error = "<center><span>Input New Password</span></center>";
       }
      }
      }else{
        $error = "<center><span>User Not Found</span></center>";
      }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <title>Log In</title>
</head>
<body>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

    <h2>Update Password</h2>

    <?php echo $error;?>

    <div class="formg">
      <label for=""><b>Email:</b></label>
      <input type="email" class="input" name="info" placeholder="example@gmail.com" value="<?php echo htmlspecialchars($info);?>">
    </div>

    <div class="formg">
      <label for=""><b>Password:</b></label>
      <input type="password"  class="input" name="password" placeholder="Password" id="lshow" maxlength="10" minlength="6" value="<?php echo htmlspecialchars($pass);?>">
        <label for=""><input type="checkbox" name="" id="show">Show</label>
    </div>

    <div class="formg">
      <label for=""><b>Confirm Password:</b></label>
      <input type="password"  class="input" name="cpassword" placeholder="Confirm Password" id="lshow" maxlength="10" minlength="6">
        <label for=""><input type="checkbox" name="" id="cshow">Show</label>
    </div>

    <button type="submit"><i class="fa-solid fa-rotate"></i> Update</button>
  </form>

  <script src="script3.js"></script>
</body>
</html>