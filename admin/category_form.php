<?php require '../tools/db.php'; ?>

<?php
  if(!isset($_SESSION['is_admin']) OR $_SESSION['is_admin'] == 0){
    header('location:../index.php');
    exit;
  }

  if(isset($_POST['save']) ){
    $query = $db->prepare('INSERT INTO category (name, summary) VALUES (?, ?)');
    $newCategory = $query->execute(
      [
        $_POST['name'],
        $_POST['summary']
      ]
    );

    if($newCategory){
        header('location:category_list.php');
        exit;
    }
    else {
        $message = "Impossible d'enregistrer la nouvelle categorie...";
    }
  }

  if(isset($_POST['update'])){
  	$query = $db->prepare('UPDATE category SET
  		name = :name,
  		summary = :summary
  		WHERE id = :id'
  	);

	//données du formulaire
	$result = $query->execute(
		[
      'name' => $_POST['name'],
			'summary' => $_POST['summary'],
			'id' => $_POST['id']
		]
	);

	if($result){

        header('location:category_list.php');
        exit;
    }
    else {
        $message = "Impossible d'enregistrer la nouvelle categorie...";
    }
}

//si on modifie une catégorie, on doit séléctionner la catégorie en question (id envoyé dans URL) pour pré-remplir le formulaire plus bas
if(isset($_GET['category_id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){

	$query = $db->prepare('SELECT * FROM category WHERE id = ?');
    $query->execute(array($_GET['category_id']));
	//$category contiendra les informations de la catégorie dont l'id a été envoyé en paramètre d'URL
	$category = $query->fetch();
}


 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>admin category - le Margouillat</title>
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
            <header class="pb-3">
  						<!-- Si $category existe, on affiche "Modifier" SINON on affiche "Ajouter" -->
  						<h4><?php if(isset($user)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une catégorie</h4>
  					</header>

  					<?php if(isset($message)): //si un message a été généré plus haut, l'afficher ?>
  					<div class="bg-danger text-white">
  						<?php echo $message; ?>
  					</div>
  					<?php endif; ?>

  					<!-- Si $category existe, chaque champ du formulaire sera pré-remplit avec les informations de la catégorie -->

  					<form action="category_form.php" method="post" enctype="multipart/form-data">
  						<div class="form-group">
  							<label for="name">Nom :</label>
  							<input class="form-control" <?php if(isset($category)): ?>value="<?php echo htmlentities($category['name']); ?>"<?php endif; ?> type="text" placeholder="Nom" name="name" id="name" />
  						</div>
  						<div class="form-group">
  							<label for="summary">résumé : </label>
                <textarea class="form-control" name="summary" placeholder="résumé" id="summary"><?php if(isset($category)): ?><?php echo htmlentities($category['summary']); ?><?php endif; ?></textarea>
  						</div>

  						<div class="text-right">
  							<!-- Si $category existe, on affiche un lien de mise à jour -->
  							<?php if(isset($category)): ?>
  							<input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />
  							<!-- Sinon on afficher un lien d'enregistrement d'une nouvelle catégorie -->
  							<?php else: ?>
  							<input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
  							<?php endif; ?>
  						</div>

  						<!-- Si $category existe, on ajoute un champ caché contenant l'id de la catégorie à modifier pour la requête UPDATE -->
  						<?php if(isset($category)): ?>
  						<input type="hidden" name="id" value="<?php echo $category['id']?>" />
  						<?php endif; ?>

  					</form>
          </div>
        </div>
			</div>
		</div>
  </body>
</html>
