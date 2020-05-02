<?php 
session_start();
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
	if (isset($_POST["email"]) and !empty($_POST["email"])){
		if ($_POST["formtype"] == "api") {

			$doesUserExist = FALSE;
			$lines = file($fichier);
			for($i=0;$i<sizeof($lines);$i++){	
				$line = $lines[$i];
				# remove new line character
				$line = str_replace("\n","",$line);
				$t = explode(",", $line);
				if ($t[0] == $_POST["email"]){
					$doesUserExist = TRUE;
					$ExistKeys = $t[1];
				}
			}
			if ($_POST["email"]==$_SESSION['login']){
				if( $doesUserExist == TRUE ){
					$message = "Votre clé est ".$ExistKeys;;

				}
				else{
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
    <a href="api.php">API</a>
    <a href="acceuil.php">Acceuil</a>
                
 </div>
<form action="./api.php" method="post" enctype="multipart/form-data" type="api" class="cle_api">
	<h2 id="resu">Générer ou retrouver votre clé API </h2>
	<?php  
    if (isset($message)){
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