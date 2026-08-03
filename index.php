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
  <main>
    <div class="card">
      <div class="img">
        <h2>ID: <?php echo $_SESSION['id'];?></h2>
      </div>
      <div class="info">
        <p><b>Name:</b> <?php echo $_SESSION['name'];?></p>
        <p><b>Email:</b> <?php echo $_SESSION['email'];?></p>
        <p><b>Tell:</b> <?php echo $_SESSION['number'];?></p>
      </div>
    </div>
  </main>
</body>
</html>