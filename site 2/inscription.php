<?php 
if (isset($_POST["formtype"])){
	$fichier = "account.csv";

	if ($_POST["formtype"] == "inscription") {

		$doesUserExist = FALSE;
		$lines = file($fichier);
		for($i=0;$i<sizeof($lines);$i++){	
			$line = $lines[$i];
			# remove new line character
			$line = str_replace("\n","",$line);
			$t = explode(",", $line);
			if ($t[0] == $_POST["email"]){
				$doesUserExist = TRUE;
			}
		}
		if(isset($_POST["email"]) and isset($_POST["passwordi"]) and isset($_POST["verification"]))
		{
			if( $doesUserExist == TRUE ){
				$message_erreur = ($_POST["email"])." ce login est déjà pris";
			}

			elseif ($_POST["passwordi"]!=$_POST["verification"]){
				//	$doesUserExist = TRUE;
				$message_erreur = "Les deux mot de passe ne coresspondent pas" ;
			}

			elseif (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#',$_POST['passwordi'])) {
        		$message_erreur = "Votre mot de passe doit contenir des lettres miniscules et majuscules des chiffrse et des caractères spéciaux";
			}
			elseif (!preg_match('#^(?=.*[a-z])(?=.*[.])(?=.*[@])#',$_POST['email'])) {
        		$message_erreur = " Mail non conforme";
			}
			else{
				$fichier_end = fopen($fichier,"a");
				$email = $_POST["email"];
				$mdp_a_hasher=$_POST["email"].$_POST["passwordi"];
				$hash=password_hash($mdp_a_hasher, PASSWORD_DEFAULT);
				fwrite($fichier_end, $email.",".$hash."\n");
				fclose($fichier_end);
				$message= $email." vient de s'inscrire ";
			}
		}
		else{
			$message_erreur = "Veuillez remplir tout les champs";
		}
	}
}
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    </meta>
	<title>Trombinoscope</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"></link>
</head>
<body>
<h1>Trombinoscope</h1>
<form action="./inscription.php" method="post" enctype="multipart/form-data" type="inscription" class="inscription">
	<h2 id="resu">Inscription </h2>
	<?php  
    if (isset($message)){
        echo '<div id="message">'.$message."</div>";
    }
    else{
        echo "<div id='message_erreur'>".$message_erreur."</div>";
    }
     ?>
	<div id="inscription">
	<p>Entrer votre mail:</p>
	<input type="e-mail" name="email"/></p>
	<p> Entrer votre mot de passe :</p>
	<p>
	<input type="password" name="passwordi"/></p>
	<p> Verification de votre mot de passe :</p>
	<p>
	<input type="password" name="verification"/>
	<input type="hidden" name="formtype" value="inscription" />
	<input type="submit" value="valider" class="button" />

	<input type="reset" value="recommancer" class="button" />
	
	<p>Vous avez déja un compte ?
	<a href=index.php>cliquez ici pour vous connectez</a></p>
	</p>
</div>
</form>
<footer id='haut'>
    <p>Copyright © Wasef Alexandra</p>
</footer>
</body>
</html>