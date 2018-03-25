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
  <body style="background-image: url(img/background.png);">
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
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="img/img.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="img/img2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="img/img3.jpg" alt="Third slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="img/img4.jpg" alt="fourth slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="img/img5.jpg" alt="fiveth slide">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row noMarging" style="padding-top:20px;">
          <div class="col-12 noPaddind">
            <h2>les nouveautés</h2>
            <div class="row no noMarging">
              <?php
              $query = $db->query('SELECT * FROM product LIMIT 0, 4');
              $product = $query->fetch();
               ?>
                <div class="card col-3 bacground_dark_green noBorderRadius">
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
    </div>



  </body>
</html>
