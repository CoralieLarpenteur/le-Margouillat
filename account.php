<?php require_once 'tools/db.php';?>

<!DOCTYPE html>
<html>
  <head>
    <?php require_once 'parcial/head.php' ?>
    <title><?php echo $_SESSION['user'] ?> - le margouillat</title>
  </head>
  <body style="background-image: url(img/background.png);">
    <?php if (!isset($_SESSION['user'])) :?>
      <?php
      header('location:index.php');
    	exit;
      ?>
    <?php else :?>
      <div class="row noMarging">
        <div class="col-10 offset-1 noPaddind"style="padding-top: 20px;">
          <?php require "parcial/header.php"; ?>
        </div>
        <div class="col-10 offset-1 noPaddind"style="background:white;">
          <div class="row noMarging">
            <div class="col-12 noPaddind">
              <?php require_once 'parcial/nav.php' ?>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </body>
</html>
