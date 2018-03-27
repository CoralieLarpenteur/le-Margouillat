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
          <div class="ro noMarging">
            <div class="clo-12 noPaddind">
              <h1><?php echo $_SESSION['user']; ?> <span style="font-size: 20px;"><?php echo $_SESSION['user_lastname']; ?></span></h1>
              <?php if ($_SESSION['is_admin'] == 0): ?>
                <p>attention tu n'est pas admin sur ce site</p>
              <?php else: ?>
                <p>tu est admin sur ce site tu peut acceder à la partie d'<a href="admin/index.php">administration</a> du site</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </body>
</html>
