<?php require_once 'tools/db.php';

if(isset($_POST['login'])){

	//si email ou password non renseigné
	if(empty($_POST['email']) OR empty($_POST['password'])){
		$loginMessage = "Merci de remplir tous les champs";
	}
	else{
		//on cherche un utilisateur correspondant au couple email / password renseigné
		$query = $db->prepare('SELECT *
							FROM user
							WHERE email = ? AND password = ?');
		$query->execute( array( $_POST['email'], hash('md5', $_POST['password'])));
		$user = $query->fetch();

		//si un utilisateur correspond
		if($user){
			//on prend en session ses droits d'administration pour vérifier s'il a la permission d'accès au back-office
			$_SESSION['is_admin'] = $user['is_admin'];
			$_SESSION['user'] = $user['firstname'];
			$_SESSION['user_lastname'] = $user['lastname'];
			$_SESSION['user_birthday'] = $user['birthday'];
			$_SESSION['user_civility'] = $user['civility'];
			$_SESSION['user_address'] = $user['address'];
			$_SESSION['user_country'] = $user['country'];
			$_SESSION['user_postal_code'] = $user['postal_code'];
			$_SESSION['user_email'] = $user['email'];
			//détruire $_SESSION["user_id"] sera utilisé pour une requête de pré-remplissage du formulaire user-profile.php
			$_SESSION['user_id'] = $user['id'];
		}
		else{ //si pas d'utilisateur correspondant on génère un message pour l'afficher plus bas
			$loginMessage = "Mauvais identifiants";
		}
	}
}

//En cas d'enregistrement
if(isset($_POST['register'])){

	//un enregistrement utilisateur ne pourra se faire que sous certaines conditions

	//en premier lieu, vérifier que l'adresse email renseignée n'est pas déjà utilisée
	$query = $db->prepare('SELECT email FROM user WHERE email = ?');
	$query->execute(array($_POST['email']));

	//$userAlreadyExists vaudra false si l'email n'a pas été trouvé, ou un tableau contenant le résultat dans le cas contraire
	$userAlreadyExists = $query->fetch();

	//on teste donc $userAlreadyExists. Si différent de false, l'adresse a été trouvée en base de données
	if($userAlreadyExists){
		$registerMessage = "Adresse email déjà enregistrée";
	}
	elseif(empty($_POST['firstname']) OR empty($_POST['password']) OR empty($_POST['email']) OR empty($_POST['date']) OR empty($_POST['address']) OR empty($_POST['postal_code']) OR empty($_POST['country'])){
		//ici on test si les champs obligatoires ont été remplis
        $registerMessage = "Merci de remplir tous les champs obligatoires (*)";
    }
    elseif($_POST['password'] != $_POST['password_confirm']) {
			//ici on teste si les mots de passe renseignés sont identiques
			$registerMessage = "Les mots de passe ne sont pas identiques";
    }
    else {

		//si tout les tests ci-dessus sont passés avec succès, on peut enregistrer l'utilisateur
		//le champ is_admin étant par défaut à 0 dans la base de données, inutile de le renseigner dans la requête
        $query = $db->prepare('INSERT INTO user (firstname,lastname,email,password,birthday,address,postal_code,country) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $newUser = $query->execute(
            [
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
								hash('md5', $_POST['password']),
                $_POST['date'],
								$_POST['address'],
								$_POST['postal_code'],
								$_POST['country']
            ]
        );

		//une fois l'utilisateur enregistré, on le connecte en créant sa session
		$_SESSION['is_admin'] = 0; //PAS ADMIN !
		$_SESSION['user'] = $_POST['firstname'];
		$_SESSION['user_lastname'] = $_POST['lastname'];
		$_SESSION['user_birthday'] = $_POST['birthday'];
		$_SESSION['user_civility'] = $_POST['civility'];
		$_SESSION['user_address'] = $_POST['address'];
		$_SESSION['user_country'] = $_POST['country'];
		$_SESSION['user_postal_code'] = $_POST['postal_code'];
		$_SESSION['user_email'] = $_POST['email'];
		$_SESSION['user_id'] = $_POST['id'];
    }
}

//si l'utilisateur a une session (il est connécté), on le redirige ailleurs
if(isset($_SESSION['user'])){
	header('location:index.php');
	exit;
}

 ?>





<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php require 'parcial/head.php' ?>
  </head>
  <body style="background-image: url(img/background.png);">
    <div class="row noMarging">
      <div class="col-10 offset-1 noPaddind"style="padding-top: 20px;">
        <?php require 'parcial/header.php'; ?>
      </div>
      <div class="col-10 offset-1 noPaddind"style="background:white;">
        <div class="row noMarging">
          <div class="col-12 noPaddind">
            <?php require 'parcial/nav.php'; ?>
          </div>
        </div>
        <div class="row noMarging">
          <div class="col-12 noPaddind">
            <ul class="nav nav-tabs justify-content-center nav-fill" role="tablist">
    					<li class="nav-item">
    						<a class="nav-link <?php if(isset($_POST['login']) || !isset($_POST['register'])): ?>active<?php endif; ?>" data-toggle="tab" href="#login" role="tab">Connexion</a>
    					</li>
    					<li class="nav-item">
    						<a class="nav-link <?php if(isset($_POST['register'])): ?>active<?php endif; ?>" data-toggle="tab" href="#register" role="tab">Inscription</a>
    					</li>
    				</ul>

    				<div class="tab-content">
    					<div class="tab-pane container-fluid <?php if(isset($_POST['login']) || !isset($_POST['register'])): ?>active<?php endif; ?>" id="login" role="tabpanel">

    						<form action="login-register.php" method="post" class="p-4 row flex-column">

    							<h4 class="pb-4 col-sm-8 offset-sm-2">Connexion</h4>

    							<?php if(isset($loginMessage)): ?>
    							<div class="text-danger col-sm-8 offset-sm-2 mb-4"><?php echo $loginMessage; ?></div>
    							<?php endif; ?>

    							<div class="form-group col-sm-8 offset-sm-2">
    								<label for="email">Email</label>
    								<input class="form-control" value="" type="email" placeholder="Email" name="email" id="email" />
    							</div>

    							<div class="form-group col-sm-8 offset-sm-2">
    								<label for="password">Mot de passe</label>
    								<input class="form-control" value="" type="password" placeholder="Mot de passe" name="password" id="password" />
    							</div>

    							<div class="text-right col-sm-8 offset-sm-2">
    								<input class="btn btn-success" type="submit" name="login" value="Valider" />
    							</div>

    						</form>

    					</div>
    					<div class="tab-pane container-fluid <?php if(isset($_POST['register'])): ?>active<?php endif; ?>" id="register" role="tabpanel">

    						<form action="login-register.php" method="post" class="p-4 row flex-column">

    							<h4 class="pb-4 col-sm-8 offset-sm-2">Inscription</h4>

    							<?php if(isset($registerMessage)): ?>
    							<div class="text-danger col-sm-8 offset-sm-2 mb-4"><?php echo $registerMessage; ?></div>
    							<?php endif; ?>

    							<div class="form-group col-sm-8 offset-sm-2">
    								<label for="firstname">Prénom <b class="text-danger">*</b></label>
    								<input class="form-control" value="" type="text" placeholder="Prénom" name="firstname" id="firstname" />
    							</div>
    							<div class="form-group col-sm-8 offset-sm-2">
    								<label for="lastname">Nom de famille</label>
    								<input class="form-control" value="" type="text" placeholder="Nom de famille" name="lastname" id="lastname" />
    							</div>
    							<div class="form-group col-sm-8 offset-sm-2">
    								<label for="email">Email <b class="text-danger">*</b></label>
    								<input class="form-control" value="" type="email" placeholder="Email" name="email" id="email" />
    							</div>
                  <div class="form-group col-sm-8 offset-sm-2">
                    <label for="date">date de naissance<b class="text-danger">*</b></label><br/>
                    <input type="date" name="date" id="date" value="">
                  </div>
    							<div class="form-group col-sm-8 offset-sm-2">
    								<label for="password">Mot de passe <b class="text-danger">*</b></label>
    								<input class="form-control" value="" type="password" placeholder="Mot de passe" name="password" id="password" />
    							</div>
    							<div class="form-group col-sm-8 offset-sm-2">
    								<label for="password_confirm">Confirmation du mot de passe <b class="text-danger">*</b></label>
    								<input class="form-control" value="" type="password" placeholder="Confirmation du mot de passe" name="password_confirm" id="password_confirm" />
    							</div>
									<div class="form-group col-sm-8 offset-sm-2">
										<label for="address">adresse <b class="text-danger">*</b></label>
										<input class="form-control" value="" type="text" placeholder="rentrer une adresse" name="address" id="address" />
									</div>
									<div class="form-group col-sm-8 offset-sm-2">
										<label for="postal_code">code postal <b class="text-danger">*</b></label>
										<input class="form-control" value="" type="text" placeholder="rentrer un code postal" name="postal_code" id="postal_code" />
									</div>
									<div class="form-group col-sm-8 offset-sm-2">
										<label for="country">pays <b class="text-danger">*</b></label>
										<input class="form-control" value="" type="text" placeholder="rentre un ville" name="country" id="country" />
									</div>
    							<div class="text-right col-sm-8 offset-sm-2">
    								<p class="text-danger">* champs requis</p>
    								<input class="btn btn-success" type="submit" name="register" value="Valider" />
    							</div>

    						</form>

    					</div>
    				</div>
          </div>
        </div>
      </div>
    </div>



  </body>
</html>
