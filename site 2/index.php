<?php  
session_start();
if (isset($_POST["formtype"])){
	if($_POST["formtype"] == "connexion"){
		$fichier = "./noacess/account.csv";

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

			}
		}

		if( $doesUserExist == TRUE ){
			header('Location: acceuil.php');
		}
		else{
			 $message_erreur = "Veuillez réessayer";
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
<body class="font">
<h1>Trombinoscope</h1>
<form action="./index.php" method="post">
    <h2 id="res">Connexion </h2>
    <?php  
    if (isset($message_erreur)){
        echo "<div id='message_erreur'>".$message_erreur."</div>";
    }
     ?>
    <div id="connexion">
	<p> Entrer votre login : </p>
	<p>
	<input type="e-mail" name="login"/></p>
	<p> Entrer votre mot de passe :</p>
	<p>
	<input type="password" name="password"/>
	<input type="hidden" name="formtype" value="connexion" />
	</p>

	<p>
	<input type="submit" value="valider" class="button" />
	<p>Vous n'avez pas encore de compte ?
	<a href="inscription.php" > cliquez ici pour vous inscrire</a></p>

	</p>
</div>
</form>


<footer id='haut'>
    <p>Copyright © Wasef Alexandra</p>
</footer>
</body>
</html>