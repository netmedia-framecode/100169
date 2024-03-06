<?php
$conn = mysqli_connect("localhost", "root", "", "si_inventaris_sekolah");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
