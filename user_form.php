<?php
require_once 'tools/db.php';

//Si $_POST['update'] existe, cela signifie que c'est une mise à jour d'utilisateur
if(isset($_POST['update'])){

	//début de la chaîne de caractères de la requête de mise à jour
	$queryString = 'UPDATE user SET
  type_of_account = :type_of_account,
  civility = :civility,
  email = :email,
  lastname = :lastname,
  firstname = :firstname,
  address = :address,
  postal_code = :postal_code,
  country = :country,
  birthday = :birthday,
  is_admin = :is_admin ';
	//début du tableau de paramètres de la requête de mise à jour
	$queryParameters = [
    'type_of_account' => $_POST['type_of_account'],
    'civility' => $_POST['civility'],
    'email' => $_POST['email'],
    'lastname' => $_POST['lastname'],
    'firstname' => $_POST['firstname'],
    'address' => $_POST['address'],
    'postal_code' => $_POST['postal_code'],
    'country' => $_POST['country'],
    'birthday' => $_POST['birthday'],
    'is_admin' => $_POST['is_admin'],
    'id' => $_SESSION['user_id'] ];

	//uniquement si l'admin souhaite modifier le mot de passe
	if( !empty($_POST['password'])) {
		//concaténation du champ password à mettre à jour
		$queryString .= ',password = :password ';
		//ajout du paramètre password à mettre à jour
		$queryParameters['password'] = hash('md5', $_POST['password']);
	}

	//fin de la chaîne de caractères de la requête de mise à jour
	$queryString .= 'WHERE id = :id';

	//préparation et execution de la requête avec la chaîne de caractères et le tableau de données
	$query = $db->prepare($queryString);
	$result = $query->execute($queryParameters);
	if($result){
		header('location:account.php');
		exit;
	}
	else{
		$message = 'Erreur.';
	}
}

//si on modifie un utilisateur, on doit séléctionner l'utilisateur en question (id envoyé dans URL) pour pré-remplir le formulaire plus bas
if(isset($_GET['user_id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){

	$query = $db->prepare('SELECT * FROM user WHERE id = ?');
    $query->execute(array($_GET['user_id']));
	//$user contiendra les informations de l'utilisateur dont l'id a été envoyé en paramètre d'URL
	$user = $query->fetch();
}

?>

<!DOCTYPE html>
<html>
	<head>

		<title>modification <?php $_SESSION['user'] ?> - le Margouillat</title>

		<?php require 'parcial/head.php'; ?>

	</head>
	<body style="margin-top:155px">
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
				<div class="row noMarging justify-content-md-center">
					<div class="col-8 noPaddind">

						<h1>modification des informations du compte</h1></br>

						<?php if(isset($message)): //si un message a été généré plus haut, l'afficher ?>
						<div class="bg-danger text-white">
							<?php echo $message; ?>
						</div>
						<?php endif; ?>
						<!-- Si $user existe, chaque champ du formulaire sera pré-remplit avec les informations de l'utilisateur -->

						<form action="user_form.php" method="post">
							<div class="form-group">
								<label for="type_of_account"> type de compte :</label>
								<select class="form-control" name="type_of_account" id="type_of_account" >
									<option value="0" <?php if(isset($user) && $user['type_of_account'] == 0): ?>select<?php endif; ?>>particulier</option>
									<option value="1" <?php if(isset($user) && $user['type_of_account'] == 1): ?>select<?php endif; ?>>société</option>
								</select>
							</div>
							<div class="form-group">
								<label for="civility">civilité :</label></br>
								<input type="radio" name="civility" id="civility" <?php if(isset($user) && $user['civility'] == 0): ?>checked="checked"<?php endif; ?> value="0">M
								<input type="radio" name="civility" id="civility" <?php if(isset($user) && $user['civility'] == 1): ?>checked="checked"<?php endif; ?> value="1">F
							</div>
							<div class="form-group">
								<label for="firstname">Prénom :</label>
								<input class="form-control" <?php if(isset($user)): ?>value="<?php echo $user['firstname']?>"<?php endif; ?> type="text" placeholder="Prénom" name="firstname" id="firstname" />
							</div>
							<div class="form-group">
								<label for="lastname">Nom de famille : </label>
								<input class="form-control" <?php if(isset($user)): ?>value="<?php echo $user['lastname']?>"<?php endif; ?> type="text" placeholder="Nom de famille" name="lastname" id="lastname" />
							</div>
							<div class="form-group">
								<label for="birthday">date de naissance :</label>
								<input class="form-control" type="date" name="birthday" id="birthday" <?php if(isset($user)): ?>value="<?php echo $user['birthday']?>"<?php endif; ?>>
							</div>
							<div class="form-group">
								<label for="email">Email :</label>
								<input class="form-control" <?php if(isset($user)): ?>value="<?php echo $user['email']?>"<?php endif; ?> type="email" placeholder="Email" name="email" id="email" />
							</div>
							<div class="form-group">
								<label for="password">Password <?php if(isset($user)): ?>(uniquement si vous souhaitez modifier le mot de passe actuel) <?php endif; ?>: </label>
								<input class="form-control" type="password" placeholder="Mot de passe" name="password" id="password" />
							</div>
							<div class="form-group">
								<label for="address">adresse : </label>
								<input class="form-control" <?php if(isset($user)): ?>value="<?php echo $user['address']?>"<?php endif; ?> type="text" placeholder="adresse" name="address" id="address" />
							</div>
							<div class="form-group">
								<label for="postal_code">code postal :</label>
								<input class="form-control" <?php if(isset($user)): ?>value="<?php echo $user['postal_code']?>"<?php endif; ?> type="text" placeholder="rentrer un code postal" name="postal_code" id="postal_code" />
							</div>
							<div class="form-group">
								<label for="country">pays :</label>
								<input class="form-control" <?php if(isset($user)): ?>value="<?php echo $user['country']?>"<?php endif; ?> type="text" placeholder="rentre un ville" name="country" id="country" />
							</div>

							<div class="text-right">
								<!-- Si $user existe, on affiche un lien de mise à jour -->
								<?php if(isset($user)): ?>
								<input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />
								<?php endif; ?>
							</div>

							<!-- Si $user existe, on ajoute un champ caché contenant l'id de l'utilisateur à modifier pour la requête UPDATE -->
							<?php if(isset($user)): ?>
							<input type="hidden" name="id" value="<?php echo $user['id']?>" />
							<?php endif; ?>

						</form>
					</div>
				</div>
			</div>
		</div>
		<?php require_once 'parcial/footer.php'; ?>
	</body>
</html>
