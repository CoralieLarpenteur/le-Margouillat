<script type="text/javascript">

window.onscroll = function() { header() };

function header() {
  if (document.body.scrollTop > 155 || document.documentElement.scrollTop > 155){

  }
   else {

  }
}
</script>


<div class="container" id='header'>
  <div class="row noMarging header background_platinum align-items-center"style="height:120px">
    <div class="col-1 noPaddind text_dark border-right border-dark" style="padding-left:10px;min-width: 75px">
      <p style="font-family:Impact">nous contacter</p>
      <div class="col-12 noPaddind">
        <a href="https://www.facebook.com" class="text_dark"><i class="fab fa-facebook-square fa-2x"></i></a>
        <a href="https://www.twitter.com" class="text_dark"><i class="fab fa-twitter-square fa-2x"></i></a>
        <a href="https://www.instagram.com" class="text_dark"><i class="fab fa-instagram fa-2x"></i></a>
      </div>
    </div>
    <div class="col-3 noPaddind text_dark" style="padding-left:10px;min-width: 75px">
      <p>01 22 33 44 55</p>
    </div>
    <div class="col-4 noPaddind"style="margin:auto">
      <center><a href="index.php"> <img src="../img/logo.png" alt="logo" style="height:110px"> </a></center>
    </div>
    <div class="col-4">
      <div class="row noMarging justify-content-end">
        <div class="col-3 noPaddind" style="text-align: center; z-index: 1;min-width: 20px">
          <?php if (isset($_SESSION['user'])) :?>
            <div class="dropdown show"style="">
              <a class="dropdown" style="color:#22252A; text-decoration:none;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user fa-2x"></i>
                <p><?php echo $_SESSION['user'];?></p>
              </a>
              <div class="dropdown-menu text_dark" style="overflow: visible;" aria-labelledby="dropdownMenuLink">
                <?php if ($_SESSION['is_admin'] == 1) :?>
                  <a class="dropdown-item" href="../index.php">site</a>
                  <a class="dropdown-item" href="account.php?user_id=<?php echo $_SESSION['user_id'] ?>">mon compte</a>
                <?php else :?>
                  <a class="dropdown-item" href="account.php?user_id=<?php echo $_SESSION['user_id'] ?>">mon compte</a>
                <?php endif; ?>
                <a class="dropdown-item" href="index.php?logout">déconection</a>
              </div>
            </div>
          <?php else :?>
              <a href="login-register.php" class="text_dark">
                <i class="fas fa-user fa-2x"></i>
                <p>utilisateur</p>
              </a>
          <?php endif; ?>

        </div>
        <div class="col-3 noPaddind" style="text-align: center;min-width: 75px">
          <a href="#" class="text_dark">
            <i class="fas fa-shopping-cart fa-2x"></i>
            <p>panier</p>
          </a>
        </div>
      </div>
    </div>

  </div>
</div>
