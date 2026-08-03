<?php

session_start();

// Conection to database
include("connection.php");


// Php sign up logic
$name = $email = $tel = $password = $cpassword = $hpass = '';
$vname = $vemail = $vtel = $hpass ='';
$errorname = $erroremail = $errortel = $errorsql = $errorpass = $errorc = '';

if ($_SERVER['REQUEST_METHOD']=='POST') {
  if(empty($_POST['name'])){
    $errorname = "<span>Input Name</span>";
  }else{
    $name = htmlspecialchars(trim(stripcslashes($_POST['name'])));
    if (!preg_match("/^[a-zA-Z-' ]+$/", $name)) {
      $errorname = "<span>Invalid Name</span>";
    } elseif (empty($_POST['email'])){
      $erroremail = "<span>Input Email</span>";
    } else{
      $email = htmlspecialchars(trim(stripcslashes($_POST['email'])));
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erroremail = "<span>Invalid Email</span>";
      }elseif (empty($_POST['tel'])){
        $errortel = "<span>Input Tel</span>";
      } else{
        $tel = htmlspecialchars(trim(stripcslashes($_POST['tel'])));
        if (!preg_match("/^[6]?[^13460]{1}[0-9]{7}$/", $tel)){
          $errortel = "<span>Invalid Cameroon Number</span>";
        } elseif (empty($_POST['password'])){
          $errorpass = "<span>Input Password</span>";
        } else{
          $password = $_POST['password'];
          if(strlen($password)<6 || strlen($password)>10){
            $errorpass = "<span>Password must be between 6-10 characters</span>";
          }elseif (empty($_POST['cpassword'])){
            $errorc = "<span>Confirm Password</span>";
          }else{
            $cpassword = $_POST['cpassword'];
            if($cpassword !== $password){
              $errorc = "<span>Incorrect Password</span>";
            }else{
              $hpass = password_hash($password, PASSWORD_BCRYPT);

              $sql = "INSERT INTO user_info(name,email,number,password) VALUES('$name', '$email', $tel, '$hpass');";
              $user = mysqli_query($conn, $sql);
              if($user){
                mysqli_close($conn);
                header("Location: index.php");
                exit();
              } else{
                $errorsql = "<center><span>".mysqli_error($conn)."</span></center>";
              }
            }
          }
        }
      }
    }
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
  <title>Sign Up</title>
</head>
<body>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

  <h2>Sign Up</h2>

  

    <div class="formg">
      <label for=""><b>Name:</b></label>
      <input type="text" class="input" name="name" placeholder="Name" value="<?php echo htmlspecialchars($name);?>">
      <?php echo $errorname;?>
    </div>

    <div class="formg">
      <label for=""><b>Email:</b></label>
      <input type="email" class="input" name="email" placeholder="example@gmail.com" value="<?php echo htmlspecialchars($email);?>">
      <?php echo $erroremail; ?>
    </div>
    <div class="formg">
      <label for=""><b>Telephone:</b></label>
      <input type="tel" class="input" name="tel" placeholder="6XXXXXXXX" minlength="8" maxlength="9" value="<?php echo htmlspecialchars($tel);?>">
      <?php echo $errortel; ?>
    </div>

    <div class="formg">
      <label for=""><b>Password:</b></label>
      <input type="password" class="input" name="password" placeholder="Password" maxlength="10" minlength="6" value="<?php echo htmlspecialchars($password);?>">
      <label for=""><input type="checkbox" name="" id="show">Show</label>
      <?php echo $errorpass; ?>
    </div>

    <div class="formg">
      <label for=""><b>Confirm Password:</b></label>
      <input type="password" class="input" name="cpassword" placeholder="Confirm Password">
      <label for=""><input type="checkbox" name="" id="cshow">Show</label>
      <?php echo $errorc; ?>
    </div>

    <button type="submit" name="submit"><i class="fa-solid fa-user"></i> Sign Up</button><br>
    <?php echo $errorsql;?>
    <br>
    <a href="login.php">Log In</a>
  </form>

  <script src="script.js"></script>
</body>
</html>