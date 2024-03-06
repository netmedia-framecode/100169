<?php if (!isset($_SESSION)) {
  session_start();
}
require_once("../controller/script.php");
if (isset($_SESSION["project_si_inventaris_sekolah"])) {
  unset($_SESSION["project_si_inventaris_sekolah"]);
  header("Location: ./");
  exit();
}
