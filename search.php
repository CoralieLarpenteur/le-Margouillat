<?php

require_once 'tools/db.php';

/*
$query = $db->prepare('SELECT *
FROM product
WHERE title LIKE %$_GET["search"]%
OR content LIKE %$_GET["search"]% ');
$query->execute( array( $_GET['id'] ) );

$product = $query->fetch();
*/


 ?>


<!DOCTYPE html>
<html>
  <head>
    <?php require_once 'parcial/head.php'; ?>
    <title></title>

  </head>
  <body style="margin-top:155px">
    <div class="row noMarging">
      <div class="col-12 noPaddind"style="padding-top: 20px;font-family:Impact;">
        <?php require "parcial/header.php"; ?>
      </div>
      <div class="col-12 noPaddind" style="font-family:Impact;">
        <?php require_once 'parcial/nav.php'; ?>
      </div>
      <div class="col-10 offset-1 noPaddind text_dark">
        <?php if (isset($_GET['search'])): ?>
          <h1>RÉSULTATS DE RECHERCHE POUR : '<?php echo $_GET['search']; ?>'</h1>
        <?php endif; ?>

        <?php if (isset($_GET['submit']) && isset($_GET['search'])): ?>

          <?php
          $require = $_GET['search'];
          $query = $db->query("SELECT * FROM product WHERE title LIKE '%$require%'");
          $search = $query->fetch();

          ?>

          <?php if ($search == false || $_GET['search'] == ''): ?>
            <h1>aucun resultat trouvé</h1>
          <?php else: ?>
            <div class="row noMarging">
              <div class="card col-lg-2 col-md-4 col-sm-8 noPaddind noBorderRadius background_platinum cart" style="margin:0px 10px 20px 10px">
                <div class="card-body cart">
                  <a href="product?id=<?php echo $search['id'] ?>" style="text-decoration:none"><h5 class="card-title text_red"> <?php echo $search['title'] ?> </h5>
                  <img class="card-img-top" src="img/product/<?php echo $search['image']?>" alt="Card image cap">
                  <p class="text_red"> <?php echo $search['price']; ?> </p>
                </a>
                  <a href="#" class="btn noBorderRadius text_red"><i class="fas fa-shopping-cart fa-1x"></i>Ajouter au panier</a>
                </div>
              </div>
              <?php while ($product = $query->fetch()): ?>
                <div class="card col-lg-2 col-md-4 col-sm-8 noPaddind noBorderRadius background_platinum cart" style="margin:0px 10px 20px 10px">
                  <div class="card-body cart">
                    <a href="product?id=<?php echo $search['id'] ?>" style="text-decoration:none"><h5 class="card-title text_red"> <?php echo $search['title'] ?> </h5>
                    <img class="card-img-top" src="img/product/<?php echo $search['image']?>" alt="Card image cap">
                    <p class="text_red"> <?php echo $search['price']; ?> </p>
                  </a>
                    <a href="#" class="btn noBorderRadius text_red"><i class="fas fa-shopping-cart fa-1x"></i>Ajouter au panier</a>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>
        <?php else: ?>
          <h1>aucun resultat trouvé</h1>
        <?php endif; ?>

      </div>
    </div>
    <?php require_once 'parcial/footer.php'; ?>
  </body>
</html>
