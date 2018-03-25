<?php require '../tools/db.php'; ?>

<?php
  if(!isset($_SESSION['is_admin']) OR $_SESSION['is_admin'] == 0){
  	header('location:../index.php');
  	exit;
  }

  if(isset($_POST['save'])){
    $query = $db->prepare('INSERT INTO product (product_category, title, content, price, is_published, in_stock) VALUES (?, ?, ?, ?, ?, ?)');
    $result = $query->execute(
      [
        $_POST['category_id'],
        $_POST['title'],
        $_POST['content'],
        $_POST['price'],
        $_POST['is_published'],
        $_POST['in_stock'],
      ]
    );


  	//redirection après enregistrement
  	//si $newArticle alors l'enregistrement a fonctionné
  	if($result){

  		//upload de l'image si image envoyée via le formulaire
  		if(isset($_FILES['image'])){

  			//tableau des extentions que l'on accepte d'uploader
  			$allowed_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
  			//extension dufichier envoyé via le formulaire
  			$my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);

  			//si l'extension du fichier envoyé est présente dans le tableau des extensions acceptées
  			if ( in_array($my_file_extension , $allowed_extensions) ){

  				//je génrère une chaîne de caractères aléatoires qui servira de nom de fichier
  				//le but étant de ne pas écraser un éventuel fichier ayant le même nom déjà sur le serveur
  				$new_file_name = md5(rand());

  				//destination du fichier sur le serveur (chemin + nom complet avec extension)
  				$destination = '../img/product/' . $new_file_name . '.' . $my_file_extension;

  				//déplacement du fichier à partir du dossier temporaire du serveur vers sa destination
  				$result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);

  				//mise à jour de l'article enregistré ci-dessus avec le nom du fichier image qui lui sera associé
  				$query = $db->prepare('UPDATE product SET
  					image = :image
  					WHERE id = :id'
  				);
          //on récupère l'id du dernier enregistrement en base de données (ici l'article inséré ci-dessus)
          $lastInsertedArticleId = $db->lastInsertId();
  				$resultUpdateImage = $query->execute(
  					[
  						'image' => $new_file_name . '.' . $my_file_extension,
  						'id' => $lastInsertedArticleId
  					]
  				);
  			}
  		}

  		//redirection après enregistrement
  		header('location:product_list.php');
  		exit;
      }
  	else{ //si pas $newArticle => enregistrement échoué => générer un message pour l'administrateur à afficher plus bas
  		$message = "Impossible d'enregistrer le nouveau produit...";
  	}
  }


  //Si $_POST['update'] existe, cela signifie que c'est une mise à jour d'article
  if(isset($_POST['update'])){

  	$query = $db->prepare('UPDATE product SET
  		title = :title,
      product_category = :category,
  		content = :content,
      price = :price,
  		is_published = :is_published
      in_stock = :in_stock
  		WHERE id = :id'
  	);

  	//mise à jour avec les données du formulaire
    	$resultProduct = $query->execute(
        [
          'title' => $_POST['title'],
          'category' => $_POST['category_id'],
          'content' => $_POST['content'],
          'is_published' => $_POST['is_published'],
          'price' => $_POST['price'],
          'in_stock' => $_POST['in_stock'],
          'id' => $_POST['id']
    		]
      );


  	//si enregistrement ok
  	if($resultProduct){
          if(isset($_FILES['image'])){

              $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
              $my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);

              if ( in_array($my_file_extension , $allowed_extensions) ){

  				//si un fichier est soumis lors de la mise à jour, je commence par supprimer l'ancien du serveur s'il existe
  				if(isset($_POST['current-image'])){
  					unlink('../img/product/' . $_POST['current-image']);
  				}

                  $new_file_name = md5(rand());
                  $destination = '../img/product/' . $new_file_name . '.' . $my_file_extension;
                  $result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);

                  $query = $db->prepare('UPDATE product SET
  					image = :image
  					WHERE id = :id'
                  );
                  $resultUpdateImage = $query->execute(
                      [
                          'image' => $new_file_name . '.' . $my_file_extension,
                          'id' => $_POST['id']
                      ]
                  );
              }
          }

          header('location:product_list.php');
          exit;
      }
  	else{
  		$message = 'Erreur.';
  	}
  }

  //si on modifie un article, on doit séléctionner l'article en question (id envoyé dans URL) pour pré-remplir le formulaire plus bas
  if(isset($_GET['product_id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){
  	$query = $db->prepare('SELECT * FROM product WHERE id = ?');
      $query->execute(array($_GET['product_id']));
  	//$article contiendra les informations de l'article dont l'id a été envoyé en paramètre d'URL
  	$product = $query->fetch();
  }






 ?>

<!DOCTYPE html>
<html>
  <head>
    <?php require 'parcial/head.php'; ?>
    <title>admin product - le Margouillat</title>
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
        			<!-- Si $article existe, on affiche "Modifier" SINON on affiche "Ajouter" -->
        			<h4><?php if(isset($product)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> un article</h4>
        		</header>
        		<?php if(isset($message)): //si un message a été généré plus haut, l'afficher ?>
        		<div class="bg-danger text-white">
        			<?php echo $message; ?>
        		</div>
        		<?php endif; ?>

        		<!-- Si $article existe, chaque champ du formulaire sera pré-remplit avec les informations de l'article -->
        		<form action="product_form.php" method="post" enctype="multipart/form-data">

        			<div class="form-group">
        				<label for="title">Titre :</label>
        				<input class="form-control" <?php if(isset($product)): ?>value="<?php echo htmlentities($product['title']); ?>"<?php endif; ?> type="text" placeholder="Titre" name="title" id="title" />
        			</div>
        			<div class="form-group">
        				<label for="content">Contenu :</label>
        				<textarea class="form-control" name="content" id="content" placeholder="Contenu"><?php if(isset($product)): ?><?php echo htmlentities($product['content']); ?><?php endif; ?></textarea>
        			</div>
              <div class="form-group">
                <label for="price">prix :</label>
                <input class="form-control" <?php if(isset($product)): ?>value="<?php echo htmlentities($product['price']); ?>"<?php endif; ?> type="text" placeholder="prix" name="price" id="price" />
              </div>
              <div class="form-group">
                <label for="in_stock">stock :</label>
                <input class="form-control" <?php if(isset($product)): ?>value="<?php echo htmlentities($product['in_stock']); ?>"<?php endif; ?> type="text" placeholder="stock" name="in_stock" id="in_stock" />
              </div>

        			<div class="form-group">
        				<label for="image">Image :</label>
        				<input class="form-control" type="file" name="image" id="image" />
        				<?php if(isset($product) && $product['image']): ?>
        				<img class="img-fluid py-4" src="../img/product/<?php echo $product['image']; ?>" alt="" />
        				<input type="hidden" name="current-image" value="<?php echo $product['image']; ?>" />
        				<?php endif; ?>
        			</div>

        			<div class="form-group">
        				<label for="category_id"> Catégorie </label>
        				<select class="form-control" name="category_id" id="category_id">
        					<?php
        					$queryCategory= $db ->query('SELECT * FROM category');
        					while($category = $queryCategory->fetch()):
        					  ?>
        						<option value="<?php echo $category['id']; ?>"> <?php echo $category['name']; ?> </option>

        					<?php endwhile; ?>

        				</select>
        			</div>

        			<div class="form-group">
        				<label for="is_published"> Publié ?</label>
        				<select class="form-control" name="is_published" id="is_published">
        					<option value="0" <?php if(isset($product) && $product['is_published'] == 0): ?>selected<?php endif; ?>>Non</option>
        					<option value="1" <?php if(isset($product) && $product['is_published'] == 1): ?>selected<?php endif; ?>>Oui</option>
        				</select>
        			</div>


        		  <div class="text-right">
        			<!-- Si $article existe, on affiche un lien de mise à jour -->
        			<?php if(isset($product)): ?>
        			<input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />
        			<!-- Sinon on afficher un lien d'enregistrement d'un nouvel article -->
        			<?php else: ?>
        			<input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
        			<?php endif; ?>
        		  </div>

        		  <!-- Si $article existe, on ajoute un champ caché contenant l'id de l'article à modifier pour la requête UPDATE -->
        		  <?php if(isset($product)): ?>
        		  <input type="hidden" name="id" value="<?php echo $product['id']; ?>" />
        		  <?php endif; ?>

        		</form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
