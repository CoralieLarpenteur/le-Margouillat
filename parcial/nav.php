<div class="row nav noMarging" style="box-shadow: 0px 6px 20px black;">
  <div class="col-12 noPaddind">
    <nav class="navbar navbar-expand-lg navbar bg bacground_dark">

      <button class="navbar-toggler text_brown" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class=" navbar-nav" >
          <?php
            $query = $db->query('SELECT * FROM category');
            $category = $query->fetch();
            ?>
              <li class="nav-item">
                <a class="nav-link" style="color:white" onMouseOver="$(this).css('color', 'white');" href="category.php?category_id=<?php echo $category ['id']; ?>"><?php echo $category ['name'] ?></a>
              </li>
          <?php
            while( $category = $query->fetch() ):
           ?>
              <li class="nav-item">
                <a class="nav-link"  style="color:white" onMouseOver="$(this).css('color', 'white');" href="category.php?category_id=<?php echo $category ['id']; ?>"><?php echo $category ['name'] ?></a>
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
