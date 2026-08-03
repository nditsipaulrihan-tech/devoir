<?php

$host = "localhost";
$name = "root";
$password = "";
$database = "task_one";
$conn = '';
  
$conn = mysqli_connect($host, $name, $password, $database);

if($conn){

}else{
  echo "<script>alert('Unable To Reach Database');</script>";
}

?>