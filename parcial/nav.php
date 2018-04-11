<div class="row nav noMarging justify-content-center" style="box-shadow: 0px 6px 20px black;">
  <div class="col-12 noPaddind">
    <nav class="navbar navbar-expand-lg navbar bacground_dark">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon background_platinum"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">

        <form class="form-inline my-2 my-lg-0" action="search.php?<?php if (isset($_POST['submit'])): ?>action=submit&search=<?php $_POST['search'] ?>"<?php endif; ?> method="post">
          <input class="form-control mr-sm-2 background_dark" type="search" placeholder="Search" aria-label="Search"name="search">
          <button class="btn btn-outline my-2 my-sm-0" type="submit" name="submit"><i class="fas fa-search"></i></button>
        </form>

        <ul class=" navbar-nav" >
          <?php
            $query = $db->query('SELECT * FROM category');
            $category = $query->fetch();
            ?>
              <li class="nav-item">
                <a class="nav-link text_platinum" href="category.php?category_id=<?php echo $category ['id']; ?>"><?php echo $category ['name'] ?></a>
              </li>
          <?php
            while( $category = $query->fetch() ):
           ?>
              <li class="nav-item">
                <a class="nav-link text_platinum" href="category.php?category_id=<?php echo $category ['id']; ?>"><?php echo $category ['name'] ?></a>
              </li>
          <?php
        endwhile;
        $query->closeCursor();
           ?>
        </ul>
      </div>
    </nav>

  </div>
</div>
