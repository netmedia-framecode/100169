<?php
$conn = mysqli_connect("localhost", "root", "Netmedia040700_", "si_inventaris_sekolah");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
