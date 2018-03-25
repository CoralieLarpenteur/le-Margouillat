<?php

require_once '../tools/db.php';

if(!isset($_SESSION['is_admin']) OR $_SESSION['is_admin'] == 0){
	header('location:../index.php');
	exit;
}

?>

<!DOCTYPE html>
<html>
	<head>

		<title>Administration - Mon premier blog !</title>

		<?php require 'parcial/head.php'; ?>

	</head>
	<body style="background-image: url(../img/background.png);">
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
	</body>
</html>
