<?php

require_once '../tools/db.php';

if(!isset($_SESSION['is_admin']) OR $_SESSION['is_admin'] == 0){
	header('location:../index.php');
	exit;
}

if(isset($_GET['category_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){

	$query = $db->prepare('DELETE FROM category WHERE id = ?');
	$result = $query->execute(
		[
			$_GET['category_id']
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

//séléctionner toutes les catégories pour affichage de la liste
$query = $db->query('SELECT * FROM category');
$categories = $query->fetchall();

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
					<div class="col-12 noPaddind">

						<header class="pb-4 d-flex justify-content-between">
							<h4>Liste des catégories</h4>
							<a class="btn btn-primary" href="category_form.php">Ajouter une catégorie</a>
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
									<th>Name</th>
									<th>Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>

								<?php if($categories): ?>
								<?php foreach($categories as $category): ?>

								<tr>
									<!-- htmlentities sert à écrire les balises html sans les interpréter -->
									<th><?php echo htmlentities($category['id']); ?></th>
									<td><?php echo htmlentities($category['name']); ?></td>
									<td><?php echo htmlentities($category['summary']); ?></td>
									<td>
										<a href="category_form.php?category_id=<?php echo $category['id']; ?>&action=edit" class="btn btn-warning">Modifier</a>
										<a onclick="return confirm('Are you sure?')" href="category_list.php?category_id=<?php echo $category['id']; ?>&action=delete" class="btn btn-danger">Supprimer</a>
									</td>
								</tr>

								<?php endforeach; ?>
								<?php else: ?>
									Aucune catégorie enregistré.
								<?php endif; ?>

							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
		<?php require_once 'parcial/footer.php'; ?>
	</body>
</html>
