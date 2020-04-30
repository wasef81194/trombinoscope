<?php 
if (isset($_POST["formtype"])){
	$fichier = "document.csv";

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
		elseif(!isset($_POST["nom"]) or !$_POST["prenom"]){
			$message_erreur = " Un champs n'a pas été remplie ";
		}

		else{
			if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
    		{
    		$tailleMax = 2097152;
        	$extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
        	if($_FILES['avatar']['size'] <= $tailleMax)
        	{
            	$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
            	if(in_array($extensionUpload, $extensionsValides))
            	{   
                	$chemin = "photo/".$_POST["email"].".".$extensionUpload;
                	$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                	if($resultat)
                	{
                    	$fichier_end = fopen($fichier,"a");
						$email = $_POST["email"];
						$mdp_a_hasher=$_POST["email"].$_POST["passwordi"];
						$hash=password_hash($mdp_a_hasher, PASSWORD_DEFAULT);
						fwrite($fichier_end, $email.",".$hash.",".$_POST["nom"].",".$_POST["prenom"].",".$_POST["filiere"].",".$_POST["groupe"].",".$chemin."\n");
						fclose($fichier_end);
						$message= $email." vient de s'inscrire ";
                	}
                	else
               		{
                   	 $message_erreur = "Erreur durant l'importation de votre photo de profil";
                	}
            	}
            	else
            	{
                	$message_erreur = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
            	}
        	}
        	else
        	{
            	$message_erreur = "Votre photo de profil ne doit pas dépasser 2Mo";
        	}
    	}
    	else{

        	$message_erreur = "Vous n'avez pas mis de photo ";
        }
		}
	}
}
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    </meta>
	<title>Trombinoscope-API</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"></link>
</head>
<body>
<div id="carte">
<h1>Trombinoscope-API</h1>
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
	<p>Entrer votre Nom:</p>
	<input type="e-mail" name="nom"/></p>
	<p>Entrer votre Prénom:</p>
	<input type="e-mail" name="prenom"/></p>
	<p>Entrer votre fillière:</p>
	<select name="filiere">
    	<option name ='f1' >MIPI</option>
    	<option name ='f2' >LPI</option>
    	<option name ='f3' >LI</option>
    	<option name ='f4' >LPI-RIWS</option>
    	<option name ='f5' >LPI RS</option>
    </select>
    <p>Entrer votre groupe :</p>
    <select name="groupe">
    	<option name ='g1' >L1</option>
    	<option name ='g2' >L2</option>
    	<option name ='g3' >L3</option>
    </select>
	<p>Entrer votre mail:</p>
	<input type="e-mail" name="email"/></p>
	<p> Entrer votre mot de passe :</p>
	<p>
	<input type="password" name="passwordi"/></p>
	<p> Verification de votre mot de passe :</p>
	<p>
	<input type="password" name="verification"/>
	<p> Saissiez votre photo de profil :</p>
	<p><input type="file" name="avatar" /></p>
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
</div>
</body>
</html>