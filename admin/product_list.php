<?php

require_once '../tools/db.php';

if(!isset($_SESSION['is_admin']) OR $_SESSION['is_admin'] == 0){
	header('location:../index.php');
	exit;
}

//supprimer le produit

if(isset($_GET['product_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){

	$query = $db->prepare('DELETE FROM product WHERE id = ?');
	$result = $query->execute(
		[
			$_GET['product_id']
		]
	);
	//générer un message à afficher plus bas pour l'administrateur
	if($result){
		$message = "Suppression efféctuée.";
	}
	else{
		$message = "Impossible de supprimer la séléction.";
	}
}

$query = $db->query('SELECT * FROM product');
$product = $query->fetchall();



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
				<div class="row noMarging">
					<div class="col-12 noPaddind">
						<header class="pb-4 d-flex justify-content-between">
							<h4>Liste des produit</h4>
							<a class="btn btn-primary" href="product_form.php">Ajouter un produit</a>
						</header>

						<?php if(isset($message)): //si un message a été généré plus haut, l'afficher ?>
						<div class="bg-success text-white p-2 mb-4">
							<?php echo $message; ?>
						</div>
						<?php endif; ?>

						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Titre</th>
									<th>Publié</th>
									<th>stock</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>

								<?php if($product): ?>
								<?php foreach($product as $product): ?>

								<tr>
									<!-- htmlentities sert à écrire les balises html sans les interpréter -->
									<th><?php echo htmlentities($product['id']); ?></th>
									<td><?php echo htmlentities($product['title']); ?></td>
									<td>
										<?php if($product['is_published'] == 1): ?>
										Oui
										<?php else: ?>
										Non
										<?php endif; ?>
									</td>
									<td><?php echo $product['in_stock'] ?></td>
									<td>
										<a href="product_form.php?product_id=<?php echo $product['id']; ?>&action=edit" class="btn btn-warning">Modifier</a>
										<a onclick="return confirm('Are you sure?')" href="product_list.php?product_id=<?php echo $product['id']; ?>&action=delete" class="btn btn-danger">Supprimer</a>
									</td>
								</tr>

								<?php endforeach; ?>
								<?php else: ?>
									Aucun produit enregistré.
								<?php endif; ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
