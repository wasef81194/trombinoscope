<?php
session_start();
 /*elseif(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
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
                	if(!$resultat)
                	{
                    	echo "importation Réusie";
                	}
                	else
               		{
                   	 echo "Erreur durant l'importation de votre photo de profil <p id ='bouton'><a href=inscription.php>Retour</a></p>";
                   	 $doesUserExist = TRUE;
                	}
            	}
            	else
            	{
                	echo "Votre photo de profil doit être au format jpg, jpeg, gif ou png<p id ='bouton'><a href=inscription.php>Retour</a></p> ";
                	$doesUserExist = TRUE;
            	}
        	}
        	else
        	{
            	echo "Votre photo de profil ne doit pas dépasser 2Mo <p id ='bouton'><a href=inscription.php>Retour</a></p>";
            	$doesUserExist = TRUE;
        	}
    	}*/















echo'<html>
		<head>
   			 <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
			<title>Trombinoscope-API</title>
			<link rel="stylesheet" type="text/css" href="css/style.css">
		</head>
		<body>
			<div  id="carte">
			<h1>Trombinoscope-API</h1>';

/*function genererChaineAleatoire($longueur = 10)
{
 $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 $longueurMax = strlen($caracteres);
 $chaineAleatoire = '';
 for ($i = 0; $i < $longueur; $i++)
 {
 $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
 }
 return $chaineAleatoire;
}
//Utilisation de la fonction
$chaine = genererChaineAleatoire(10);
//echo $chaine;*/

if (isset($_POST["formtype"])){
	$fichier = "./noacess/document.csv";

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
			echo"<p id ='co_'> ".($_POST["email"])." ce login est déjà pris</p><p id ='bouton'><a href=inscription.php>Retour</a></p>";
		}

		elseif ($_POST["passwordi"]!=$_POST["verification"]){
			//	$doesUserExist = TRUE;
				echo "les deux mot de passe ne coresspondent pas<p id ='bouton'><a href=inscription.php>Retour</a></p>" ;
			}

		elseif (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#',$_POST['passwordi'])) {
			//$doesUserExist = TRUE;
        	echo "<p>Mot de passe non conforme</p> <p>Votre mot de passe doit contenir des lettre miniscule et majuscule des chiffre et des caractère spéciaux</p><p id ='bouton'><a href=inscription.php>Veuillez réssayer</a></p> ";
		}
		elseif (!preg_match('#^(?=.*[a-z])(?=.*[.])(?=.*[@])#',$_POST['email'])) {
			//$doesUserExist = TRUE;
        	echo "<p>Mail non conforme</p><p id ='bouton'><a href=inscription.php>Veuillez réssayer</a></p> ";
		}
		elseif(!isset($_POST["nom"]) or !$_POST["prenom"]){
			echo "<p>Un champs n'a pas été remplie </p><p id ='bouton'><a href=inscription.php> Retour</a></p>";
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
						echo "<p id ='co_'>".$email." vient de s'inscrire </p>.<p id ='bouton'><a href=index.php>Connectez-vous</a></p>";
                	}
                	else
               		{
                   	 echo "Erreur durant l'importation de votre photo de profil <p id ='bouton'><a href=inscription.php>Retour</a></p>";
                   	 //$doesUserExist = TRUE;
                	}
            	}
            	else
            	{
                	echo "Votre photo de profil doit être au format jpg, jpeg, gif ou png<p id ='bouton'><a href=inscription.php>Retour</a></p> ";
                	//$doesUserExist = TRUE;
            	}
        	}
        	else
        	{
            	echo "Votre photo de profil ne doit pas dépasser 2Mo <p id ='bouton'><a href=inscription.php>Retour</a></p>";
            	//$doesUserExist = TRUE;
        	}
    	}
    	else{

        	echo "<p>vous n'avez pas mis de photo </p><p id ='bouton'><a href=inscription.php>Retour</a></p>";
        }
		}
	}
	
	elseif($_POST["formtype"] == "connexion"){


		$doesUserExist = FALSE;
		$lines = file($fichier);
		for($i=0;$i<sizeof($lines);$i++){	
			$line = $lines[$i];
			# remove new line character
			$line = str_replace("\n","",$line);
			$t = explode(",", $line);
			$mdp_verify=$_POST["login"].$_POST["password"];
			$verify_hash=password_verify($mdp_verify, $t[1]);
			if ($t[0] == $_POST["login"] and $t[1] == $verify_hash){
				$doesUserExist = TRUE;
				$_SESSION['login']=$t[0];
		   		$_SESSION['password']=$t[1];
		    	$_SESSION['nom']=$t[2];
		    	$_SESSION['prenom']=$t[3];
		    	$_SESSION['filiere']=$t[4];
		    	$_SESSION['groupe']=$t[5];
		    	$_SESSION['photo']=$t[6];

			}
		}

		if( $doesUserExist == TRUE ){
			echo " <p id ='co_'>Bienvenu ! ".$_POST["login"]."<p id ='co'> Connexion établie </p>
			<p id ='bouton'><a href=acceuil.php>Continuez</a></p>";
			//header('Location: acceuil.php');
		}
		else{
			echo "<p id ='co_'>Veuillez réssayer <p id ='bouton'><a href=index.php>Retour</a></p>";
		}
		
	}

	else{
		header('Location: index.php');
	}
}
else{
	header('Location: index.php');
}


?>
<footer id='bas'>
   <p>Copyright © Wasef Alexandra</p> 
</footer>
</div>
</body>
</html>