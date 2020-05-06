<?php  
session_start();
function logs(){//Fonction qui enregistre les connexion a cette page heurodaté
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
if (isset($_SESSION['login'])) {// si la session existe tu affichage de la page si non redirect vers la page de connexion
	//genere une clé aleatoirement
function GenereKeys($length=10){
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for($i=0; $i<$length; $i++){
        $string .= $chars[rand(0, strlen($chars)-1)];
    }
    return $string;
}

if (isset($_POST["formtype"])){
	$fichier = "./noacess/keys.csv";
	if (isset($_POST["email"]) and !empty($_POST["email"])){//si la mail existe
		if ($_POST["formtype"] == "api") {

			$KeyExist = FALSE;
			$lines = file($fichier);
			for($i=0;$i<sizeof($lines);$i++){	// lis chaque ligne du fichier keys.csv
				$line = $lines[$i];
				# remove new line character
				$line = str_replace("\n","",$line);
				$t = explode(",", $line);
				if ($t[0] == $_POST["email"]){
					$KeyExist = TRUE;
					$ExistKeys = $t[1];
				}
			}
			if ($_POST["email"]==$_SESSION['login']){//mail coresspondant a la session ouverte
				if( $KeyExist == TRUE ){
					$message = "Votre clé est ".$ExistKeys;//variable qui affiche la clé

				}
				else{//genere une clés
					$keys = GenereKeys(10);
					$email = $_POST["email"];
					$fichier_end = fopen($fichier,"a");
					fwrite($fichier_end,$email.",".$keys."\n");
					fclose($fichier_end);
					$message= "Votre clé est ".$keys;
				}
			}
			else {
				$message_erreur = "Entrez le mail correspondant a votre session";
			}
		}
	}
	else {
		$message_erreur = "Veuillez entrez votre e-mail";
	}
}
		

//fonction qui permet de savoir si l'utilisateur a generer ou vu sa clé API
function logsSeeKey(){
  $date = "[".date('d')."/".date('m')."/".date('y')."] ";
  $hour = "[".date('H').":".date('i').":".date('s')."] ";
  $ip = $_SERVER['REMOTE_ADDR'];
  $url = $_SERVER['PHP_SELF'];
  $answer = $date.$hour.$ip." saw his key \n";

  $files = fopen('./noacess/logs.txt', 'a+');
  fputs($files,$answer);
  fclose($files);
}

if (isset($message)){
        logsSeeKey();
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
<div class="navbar">
    <h1>Trombinoscope-API</h1>
     <a href="deconnexion.php">Déconnexion</a>
     <a href="api.php">Cle API</a>
     <a href="acceuil.php">Profil</a>
     <a href="index.php">Documentation</a>
                
 </div>
<form action="./api.php" method="post" enctype="multipart/form-data" type="api" class="cle_api">
	<h2 id="resu">Générer ou retrouver votre clé API </h2>
	<?php  
    if (isset($message)){//Affichage du message
        echo '<div id="message">'.$message."</div>";
    }
    else{
        echo "<div id='message_erreur'>".$message_erreur."</div>";
    }
     ?>
	<p>Entrer votre mail:</p>
	<input type="e-mail" name="email" value="<?php 
	if (isset($_SESSION['login'])){
		echo$_SESSION['login'];}?>"/>
	</p>
	<input type="hidden" name="formtype" value="api" />
	<input type="submit" value="valider" class="button" />

</form>

<footer>
    <p>Copyright © Wasef Alexandra</p>
</footer>
</div>
</body>
</html>
<?php
}
else{
	header('Location: connexion.php');
}
?>