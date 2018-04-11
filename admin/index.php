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
	<body style="margin-top:155px">
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
				<div class="row noMarging">
					<div class="col-12 noPaddind" style="height: 400px">
						<h1>bienvenue</h1>
						<p>vous êtes actuellement sur la page index de l'administation de votre site, cette page vous permet de voir, ajouter et modifier des <a href="product_list.php">produits</a>, <a href="category_list.php">catégories</a> et <a href="user_list.php">utilisateurs</a> </p>
					</div>
				</div>
			</div>
		</div>
		<?php require_once 'parcial/footer.php'; ?>
	</body>
</html>
