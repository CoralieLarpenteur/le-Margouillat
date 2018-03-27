<?php require_once 'tools/db.php';

if(isset($_GET['id'])){

	$query = $db->prepare('SELECT product.* , category.name AS category_name
						FROM product
						JOIN category
						ON product.product_category = category.id
						WHERE product.id = ? AND product.is_published = 1');
	$query->execute( array( $_GET['id'] ) );

	$product = $query->fetch();


  if(!$product){
    header('location:index.php');
    exit;
  }
}else{
	header('location:index.php');
	exit;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <?php require_once 'parcial/head.php' ?>
    <title> <?php echo $product['title'];?> - le Margouillat </title>
  </head>
  <body style="background-image: url(img/background.png);">
    <div class="row noMarging">
      <div class="col-10 offset-1 noPaddind"style="padding-top: 20px;">
        <?php require "parcial/header.php"; ?>
      </div>
      <div class="col-10 offset-1 noPaddind" style="background:white;">
        <div class="row noMarging">
          <div class="col-12 noPaddind">
            <?php require_once 'parcial/nav.php' ?>
          </div>
        </div>
        <div class="row noMarging">
          <div class="col-4 noPaddind">
            <div class="product_img"style="background-image: url(img/product/<?php echo $product['image'];?>);">
            </div>
          </div>
          <div class="col-5">
            <h1 class="text_dark_green"><?php echo $product['title']; ?></h1>
            <p class="text_dark_green"><?php echo $product['content']; ?></p>
          </div>
          <div class="col-3">
            <div class="card mb-3" style="max-width: 18rem;">
              <div class="card-body">
                <h3 class="card-title"> <?php echo $product['price']; ?>€ <sub>TTC</sub> </h3>
								<select class="form-control col-4" name="amount">
									<?php $quantity = 0; ?>
									<?php while ($quantity < $product['in_stock']) :?>
										<?php $quantity = $quantity+1 ?>
										<option value="<?php echo $quantity ?>"><?php echo $quantity ?></option>
									<?php endwhile; ?>
								</select>
								<?php if ($product['in_stock']>=1): ?>
										<p class="card-text alignRight" style="color:#28a745;text-align: right;"> <i class="fas fa-truck fa-1x"></i> en stock </p>
									<?php else: ?>
										<p class="card-text alignRight" style="color:#dc3545;text-align: right;"> <i class="fas fa-truck fa-1x"></i> hors stock </p>
								<?php endif; ?>
								<button type="button" class="btn btn-success"><i class="fas fa-cart-plus fa-1x"></i>																																																																																																ajouter au panier</button>
              </div>
            </div>
        </div>
      </div>
    </div>
  </body>
</html>
