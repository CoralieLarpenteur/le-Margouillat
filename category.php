<?php

require_once 'tools/db.php';

if(isset($_GET['category_id'])){

  $query = $db->prepare('SELECT * FROM category WHERE id = ?');
  $query->execute( array($_GET['category_id']) );

  $currentCategory = $query->fetch();

  if ($currentCategory) {
    $query = $db->prepare('SELECT * FROM product WHERE product_category = ? AND is_published = 1 ');
    $result = $query->execute( array($_GET['category_id']) );
//fetchAll() renvoie un ensemble d'enregistrements (tableau), le résultat sera à traiter avec un boucle foreach
    $product= $query->fetchAll();
  }else {
    header('location:index.php');
		exit;
  }
}else {
  $query = $db->query('SELECT product.* , category.name AS category_name
						FROM product
						JOIN category
						ON product.category_id = category.id WHERE is_published = 1 ORDER BY created_at DESC');
	$product = $query->fetchAll();
}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <?php require 'parcial/head.php'; ?>
    <title><?php if(isset($currentCategory)): ?><?php echo $currentCategory['name']; ?><?php else : ?>Tous les produit<?php endif; ?> - le margouillat</title>
  </head>
  <body style="margin-top:155px">
    <div class="row noMarging">
      <div class="col-10 offset-1 noPaddind"style="padding-top: 20px;">
        <?php require 'parcial/header.php'; ?>
      </div>
      <div class="col-10 offset-1 noPaddind"style="background:white;">
        <div class="row noMarging">
          <div class="col-12 noPaddind">
            <?php require 'parcial/nav.php'; ?>
          </div>
        </div>
        <div class="row noMarging">
          <div class="col-12 noPaddind impact">
            <h2><?php echo $currentCategory['name']; ?></h2>
          </div>
        </div>
        <div class="row noMarging">
          <div class="col-12 noPaddind impact">
             <div class="row noMarging">
               <?php foreach ($product as $key => $product): ?>
                 <div class="card col-3 bacground_dark_green noBorderRadius">
                   <div class="card-body">
                     <a href="product?id=<?php echo $product['id'] ?>"><h5 class="card-title text_brown"> <?php echo $product['title'] ?> </h5>
                       <img class="card-img-top" src="img/product/<?php echo $product['image']?>" alt="Card image cap">
                       <p class="text_brown"> <?php echo $product['price']; ?> </p>
                     </a>
                     <a href="#" class="btn bacground_brown text_dark_green noBorderRadius"><i class="fas fa-shopping-cart fa-1x"></i>Ajouter au panier</a>
                   </div>
                 </div>
               <?php endforeach; ?>
             </div>
           </div>
          </div>
        </div>
      </div>
    </div>
    <?php require_once 'parcial/footer.php'; ?>
  </body>
</html>
