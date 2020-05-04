<?php  
session_start();
function logs(){
  $date = "[".date('d')."/".date('m')."/".date('y')."] ";
  $hour = "[".date('H').":".date('i').":".date('s')."] ";
  $ip = $_SERVER['REMOTE_ADDR'];
  $url = $_SERVER['PHP_SELF'];
  $answer = $date.$hour.$ip." connecte to ".$url."\n";

  $files = fopen('./noacess/logs.txt', 'a+');
  fputs($files,$answer);
  fclose($files);
}
logs();
if (isset($_POST["formtype"])){
	if($_POST["formtype"] == "connexion"){
		$fichier = "./noacess/document.csv";

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
			header('Location: acceuil.php');
		}
		else{
			 $message_erreur = "Veuillez réssayer";
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
<div class="navbar">
                <h1>Trombinoscope-API</h1>
                <a href="inscription.php">Inscription</a>
                <a href="connexion.php">Connexion</a>
                <a href="index.php">Documentation</a>
                
    </div>
<form action="./connexion.php" method="post">
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
	<a href="inscription.php" class="boutton"> cliquez ici pour vous inscrire</a></p>

	</p>
</div>
</form>


<footer >
    <p>Copyright © Wasef Alexandra</p>
</footer>
</body>
</html>