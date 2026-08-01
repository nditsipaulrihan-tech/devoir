<?php

session_start();

// Conection to database
include("connection.php");


// Php sign up logic
$name = $email = $tel = $password = $cpassword = '';
$vname = $vemail = $vtel = $hpass ='';
$errorname = $erroremail = $errortel = $errorpass = $errorc = '';

if ($_SERVER['REQUEST_METHOD']=='POST') {
  if(!empty($name)){
    $name = htmlspecialchars(trim(stripslashes($_POST['name'])));
    if(!preg_match("/^[a-zA-Z-' ]*$/", $name)){
    $errorname = "<span>Invalid Name</span>";
  } else{
    $vname = mysqli_escape_string($conn, $name);

    if(empty($_POST['email'])){
    $erroremail='<span>Input email</span>';
  } else{
    $email = htmlspecialchars(trim(stripcslashes($_POST['email'])));
    if(!preg_match("/^[\w]*[@][a-z]*\.[a-z]{2,3}$/", $email)){
        $erroremail = '<span>Invalid email</span>';
    } else{
      $vemail =  mysqli_escape_string($conn, $email);

    }}}}}
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
      <input type="tel" class="input" name="tel" placeholder="2376XXXXXXXX" value="<?php echo htmlspecialchars($tel);?>">
      <?php echo $errortel; ?>
    </div>

    <div class="formg">
      <label for=""><b>Password:</b></label>
      <input type="password" class="input" name="password" placeholder="Password" maxlength="20" minlength="6" value="<?php echo htmlspecialchars($password);?>">
      <label for=""><input type="checkbox" name="" id="show">Show</label>
      <?php echo $errorpass; ?>
    </div>

    <div class="formg">
      <label for=""><b>Confirm Password:</b></label>
      <input type="password" class="input" name="cpassword" placeholder="Confirm Password" maxlength="20" minlength="6">
      <label for=""><input type="checkbox" name="" id="cshow">Show</label>
      <?php echo $errorc; ?>
    </div>

    <button type="submit" name="submit"> <i class="fa-solid fa-user"></i> Sign Up</button><br><br>
    <a href="login.php">Log In</a>
  </form>

  <script src="script.js"></script>
</body>
</html>