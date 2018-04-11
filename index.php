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
    <?php require_once 'parcial/head.php'; ?>
    <title>le margouillat</title>
  </head>
  <body style="margin-top:155px">
    <div class="row noMarging">
      <div class="col-12 noPaddind"style="padding-top: 20px;font-family:Impact;">
        <?php require "parcial/header.php"; ?>
      </div>
			<div class="col-12 noPaddind" style="font-family:Impact;">
				<?php require_once 'parcial/nav.php'; ?>
			</div>

      <div class="col-12 noPaddind">
        <img class="d-block w-100" src="img/img2.jpg" alt="Second slide">
      </div>
      <div class="row noMarging" style="padding-top:20px;">
        <div class="col-12 noPaddind" style="font-family:Impact;">
          <h1 style="margin-left:200px">Nos nouveautés</h1>
          <div class="row noMarging justify-content-center">
            <?php
            $query = $db->query('SELECT * FROM product LIMIT 0, 4');
            $product = $query->fetch();
             ?>
              <div class="card col-lg-2 col-md-4 col-sm-8 noPaddind noBorderRadius background_platinum cart" style="margin:0px 10px 20px 10px">
                <div class="card-body text_red">
                  <a href="product?id=<?php echo $product['id'] ?>" style="text-decoration:none"><h5 class="card-title text_red"> <?php echo $product['title'] ?> </h5>
                  <img class="card-img-top" src="img/product/<?php echo $product['image']?>" alt="Card image cap">
                  <p class="text_red"> <?php echo $product['price']; ?> </p>
                </a>
                  <a href="#" class="btn noBorderRadius text_red"><i class="fas fa-shopping-cart fa-1x"></i>Ajouter au panier</a>
                </div>
              </div>
            <?php while( $product = $query->fetch() ): ?>
              <div class="card col-lg-2 col-md-4 col-sm-8 noPaddind noBorderRadius background_platinum cart" style="margin:0px 10px 20px 10px">
                <div class="card-body cart">
                  <a href="product?id=<?php echo $product['id'] ?>" style="text-decoration:none"><h5 class="card-title text_red"> <?php echo $product['title'] ?> </h5>
                  <img class="card-img-top" src="img/product/<?php echo $product['image']?>" alt="Card image cap">
                  <p class="text_red"> <?php echo $product['price']; ?> </p>
                </a>
                  <a href="#" class="btn noBorderRadius text_red"><i class="fas fa-shopping-cart fa-1x"></i>Ajouter au panier</a>
                </div>
              </div>
              <?php
            endwhile;
            $query->closeCursor();
             ?>
          </div>
        </div>
      </div>
			<div class="col-12 noPaddind bacground_blue text_platinum impact" style="margin-top:30px">
				<div class="row noMarging justify-content-center">
					<div class="col-3" style="text-align:center; margin:20px 20px 20px 20px">
						<i class="far fa-box fa-5x"></i>
						<h4>NOS EMBALLAGES</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mollis nibh a euismod gravida. Aliquam sodales dolor vel malesuada faucibus. In rhoncus orci a lectus scelerisque placerat.</p>
					</div>
					<div class="col-3" style="text-align:center; margin:20px 20px 20px 20px">
						<i class="far fa-truck-moving fa-5x"></i>
						<h4>LIVRAISON</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mollis nibh a euismod gravida. Aliquam sodales dolor vel malesuada faucibus. In rhoncus orci a lectus scelerisque placerat.</p>
					</div>
					<div class="col-3" style="text-align:center; margin:20px 20px 20px 20px">
						<i class="far fa-comment-smile fa-5x"></i>
						<h4>NOTRE SERVICE APRES-VENTE</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mollis nibh a euismod gravida. Aliquam sodales dolor vel malesuada faucibus. In rhoncus orci a lectus scelerisque placerat.</p>
					</div>
				</div>
			</div>
    </div>
		<?php require_once 'parcial/footer.php'; ?>
  </body>
</html>
