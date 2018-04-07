<?php require_once 'tools/db.php';?>

<!DOCTYPE html>
<html>
  <head>
    <?php require_once 'parcial/head.php' ?>
    <title><?php echo $_SESSION['user'] ?> - le margouillat</title>
  </head>
  <body style="background-image: url(img/background.png);">
    <?php if (!isset($_SESSION['user'])) :?>
      <?php
      header('location:index.php');
    	exit;
      ?>
    <?php else :?>
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
            <div class="col-12 noPaddind" style="margin: 10px 0px 0px 10px;">
              <h4 style="display: inline">
                <i class="fas fa-user fa-2x"></i>
              </h4>
              <h1 style="display: inline">
                <?php if ($_SESSION['user_civility'] == 0): ?>
                  M<span style="font-size:20px">r</span>
                <?php else: ?>
                  M<span style="font-size:20px">me</span>
                <?php endif; ?>
                <?php echo $_SESSION['user']; ?>
              </h1>
              <h3 style="display: inline"><?php echo $_SESSION['user_lastname'] ?></h3>
              <p><?php echo $_SESSION['user_email']; ?> </br>
              <?php if ($_SESSION['is_admin'] == 1): ?>
                tu est admin sur ce site tu peut acceder à la partie d'<a class="text_black" href="admin/index.php" onMouseOver="$(this).css('color', 'black');">administration</a> du site</p>
              <?php endif; ?>
              <p> <h4 style="display: inline"><i class="fas fa-gift fa-2x"></i> date de naissance : </h4><?php echo implode('/', array_reverse(explode('-', $_SESSION['user_birthday']))); ?> </br>
              <b style="color:red;">(attention si vous avez moins de 18 ans vous ne pouvez acheter aucune arme airsoft présente sur ce site d'après le Décret n°99-240 article 2)</b></p>
              <h4><i class="fas fa-home fa-2x"></i> adresse de livraison :</h4>
              <p style="padding-left:65px;"><?php echo $_SESSION['user_address']; ?></br>
              <?php echo $_SESSION['user_postal_code']; ?> ,<?php echo $_SESSION['user_country']; ?>
              </p>
              <div class="text-right" style="padding:0px 20px 10px 0px">
  							<a href="user_form.php?user_id=<?php echo $_SESSION['user_id']; ?>&action=edit" class="btn bacground_dark_green"><span style="color:white">modifier</span></a>
  						</div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </body>
</html>
