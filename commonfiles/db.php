<?php
$host ='localhost:3306';
$dbUsername= 'root';
$dbPass= 'admin@123';
$dbName= 'adminpanel';
$conn = mysqli_connect($host,$dbUsername ,$dbPass ,$dbName);
if (!$conn) {
    die('Could not connect: ' . mysqli_error());
}
define('DB_CONN',$conn);
/*
$sql = "SELECT * FROM users";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["lastname"]. "<br>";
  }
} else {
  echo "0 results";
}
*/