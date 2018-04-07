<?php require_once 'tools/db.php';

if(isset($_GET['logout']) && isset($_SESSION['user'])){

	//la fonction unset() détruit une variable ou une partie de tableau. ici on détruit la session user
	unset($_SESSION["user"]);
	//détruire $_SESSION["user"] va permettre l'affichage du bouton connexion / inscription de la nav, et permettre à nouveau l'accès aux formulaires de connexion / inscription
	//détruire $_SESSION["is_admin"] va empêcher l'accès au back-office
	unset($_SESSION["is_admin"]);
	unset($_SESSION["user_id"]);
}

?>


<!DOCTYPE html>
<html>
  <head>
    <?php require_once 'parcial/head.php' ?>
    <title>le margouillat</title>
  </head>
  <body>
    <div class="row noMarging">
      <div class="col-12 noPaddind"style="padding-top: 20px;font-family:Impact;">
        <?php require "parcial/header.php"; ?>
      </div>
			<div class="col-12 noPaddind" style="font-family:Impact;">
				<?php require_once 'parcial/nav.php' ?>
			</div>
			<div class=""style="height:155px">

			</div>
          <div class="col-12 noPaddind">
            <img class="d-block w-100" src="img/img2.jpg" alt="Second slide">
          </div>
        <div class="row noMarging" style="padding-top:20px;">
          <div class="col-10 offset-1 noPaddind" style="font-family:Impact;">
            <h1>Nos nouveautés</h1>
            <div class="row no noMarging">
              <?php
              $query = $db->query('SELECT * FROM product LIMIT 0, 4');
              $product = $query->fetch();
               ?>
                <div class="card col-3 noBorderRadius">
                  <div class="card-body text_brown">
                    <a href="product?id=<?php echo $product['id'] ?>"><h5 class="card-title text_brown"> <?php echo $product['title'] ?> </h5>
                    <img class="card-img-top" src="img/product/<?php echo $product['image']?>" alt="Card image cap">
                    <p class="text_brown"> <?php echo $product['price']; ?> </p>
                  </a>
                    <a href="#" class="btn bacground_brown text_dark_green noBorderRadius"><i class="fas fa-shopping-cart fa-1x"></i>Ajouter au panier</a>
                  </div>
                </div>
              <?php while( $product = $query->fetch() ): ?>
                <div class="card col-3 bacground_dark_green noBorderRadius">
                  <div class="card-body">
                    <a href="product?id=<?php echo $product['id'] ?>"><h5 class="card-title text_brown"> <?php echo $product['title'] ?> </h5>
                    <img class="card-img-top" src="img/product/<?php echo $product['image']?>" alt="Card image cap">
                    <p class="text_brown"> <?php echo $product['price']; ?> </p>
                  </a>
                    <a href="#" class="btn bacground_brown text_dark_green noBorderRadius"><i class="fas fa-shopping-cart fa-1x"></i>Ajouter au panier</a>
                  </div>
                </div>
                <?php
              endwhile;
              $query->closeCursor();
               ?>
            </div>
          </div>
        </div>
    </div>



  </body>
</html>
