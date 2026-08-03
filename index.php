<?php
session_start();

include('connection.php');

if(!($_SESSION['id'])){
  header("location: login.php");
  exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Home Page</title>
</head>
<body>
  <main class="cardd">
    <div class="card">
        <div class="info">
        <p><b>User ID:</b> <?php echo $_SESSION['id'];?></p><hr><br>
        <p><b>Name:</b> <?php echo $_SESSION['name'];?></p><hr><br>
        <p><b>Email:</b> <?php echo $_SESSION['email'];?></p><hr><br>
        <p><b>Tell:</b> <?php echo $_SESSION['number'];?></p><hr><br>
        <small style="color: grey;">&copy; User Informtion</small>
      </div>
    </div>
  </main>
</body>
</html>