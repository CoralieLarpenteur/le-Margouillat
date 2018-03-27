<div class="row align-items-center">
  <div class="col-2">
    <a href="index.php"><img src="../img/logo.png"style="height:100px; width:100px;" alt="logo"></a>
  </div>
  <div class="col-8" style="padding-left: 0px;padding-right: 0px;">
    <nav class="navbar" style="padding-left: 0px;padding-right: 0px;">
      <form class="form-inline col-12" action="search.php?search=<?php echo $_POST['search'] ?>" method="post">
        <input class="form-control mr-sm-2 col-10" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline my-2 my-sm-0 col-1" type="submit"><i class="fas fa-search"></i> </button>
      </form>
    </nav>
  </div>
  <div class="col-1" style="text-align: center">
    <?php if (isset($_SESSION['user'])) :?>
      <div class="dropdown show">
        <a class="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white">
          <i class="fas fa-user fa-2x"></i>
          <p><?php echo $_SESSION['user'];?></p>
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <?php if ($_SESSION['is_admin'] == 1) :?>
            <a class="dropdown-item" href="../index.php">site</a>
          <?php else :?>
            <a class="dropdown-item" href="../account.php">mon compte</a>
          <?php endif; ?>
          <a class="dropdown-item" href="../index.php?logout">déconnexion</a>
        </div>
      </div>
    <?php else :?>
        <a href="../login-register.php" style="color:white">
          <i class="fas fa-user fa-2x"></i>
          <p>utilisateur</p>
        </a>
    <?php endif; ?>

  </div>
  <div class="col-1" style="text-align: center">
    <a href="#"style="color:white">
      <i class="fas fa-shopping-cart fa-2x"></i>
      <p>panier</p>
    </a>

  </div>
</div>


<meta charset="utf-8">
