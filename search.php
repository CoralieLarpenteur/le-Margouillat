<?php

require_once 'tools/db.php';


$query = $db->prepare('SELECT *
FROM product
WHERE title LIKE %$_GET["search"]%
OR content LIKE %$_GET["search"]% ');
$query->execute( array( $_GET['id'] ) );

$product = $query->fetch();


 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>
