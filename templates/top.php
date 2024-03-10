<?php require_once("controller/script.php"); ?>

<!DOCTYPE html>
<html style="scroll-behavior: smooth;">

<head>
  <?php require_once("sections/head.php"); ?>
</head>

<body>
  <?php foreach ($messageTypes as $type) {
    if (isset($_SESSION["project_si_inventaris_sekolah"]["message_$type"])) {
      echo "<div class='message-$type' data-message-$type='{$_SESSION["project_si_inventaris_sekolah"]["message_$type"]}'></div>";
    }
  } ?>

  <div class="hero_area">

    <div class="hero_bg_box">
      <div class="bg_img_box">
        <img src="assets/img/hero-bg.png" alt="">
      </div>
    </div>

    <?php require_once("sections/navbar.php"); ?>