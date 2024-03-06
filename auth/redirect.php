<?php
if (isset($_SESSION["project_si_inventaris_sekolah"]["users"])) {
  header("Location: ../views/");
  exit;
}
