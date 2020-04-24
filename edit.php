<?php
session_start();
/*$fichier = "document.csv";
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
		}
	}*/

?>
<html>
	<head>
   		<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
		<title>Trombinoscope-API</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
<body>
	<div  id="carte">
	<h1>Trombinoscope-API</h1>

<form action="./edit.php" method="post" class="modification">
    <h2 id="res">Modification </h2>
    <div id="modification">
    <p> Entrer votre Nom : </p>
	<p>
	<input type="text" name="nom"/></p>
	<p> Entrer votre Prénom : </p>
	<p>
	<input type="text" name="prenom"/></p>
	<p> Entrer votre email : </p>
	<p>
	<input type="e-mail" name="e-mail" value="<?php
	if(isset($_SESSION['login'])){
		echo $_SESSION['login'];
	}
	?>"/>
	</p>
	<p> Entrer votre mot de passe :</p>
	<p>
	<input type="password" name="mdp"/>
	<input type="hidden" name="formtype" value="connexion" />
	</p>
	<p>
	<input type="submit" value="valider"/>

	<input type="reset" value="recommancer"/>
	</p>
</div>
</form>

<?php
//function récrire()
$fichier = "document.csv";
//echo "SALUTTTT";
//echo $_POST["e-mail"];



//echo "SALUTTTT";
$doesUserExist = FALSE;
$lines = file($fichier);
for($i=0;$i<sizeof($lines);$i++){	
	$line = $lines[$i];
	# remove new line character
	$line = str_replace("\n","",$line);
	$t = explode(",", $line);
	if(isset($_POST["e-mail"])){
		if ($t[0] == $_POST["e-mail"] and $t[0] == $_SESSION['login'] and $t[1] == $_POST["password"] and $t[1] == $_SESSION['password'] and $t[2] == $_POST["nom"] and $t[2] == $_SESSION['nom'] and $t[3] == $_POST["prenom"] and $t[3] == $_SESSION['prenom'] and $t[4] == $_POST["filiere"] and $t[4] == $_SESSION['filiere'] and $t[5] == $_POST["groupe"] and $t[5] == $_SESSION['groupe']){
			echo "Les modification n'ont pas changer ";
			$doesUserExist = TRUE;
		}
		elseif ($t[0] != $_SESSION['login']){
				$line_saved = $line;
				//echo $line_saved;
			}
		elseif($t[0] != $_POST["e-mail"] and $t[0] == $_SESSION['login']){
			//echo $line;
			$_SESSION['login']=$_POST["e-mail"];
			$fichier_end = fopen($fichier,"w");
			$rehash = $_POST["e-mail"].$_SESSION['password'];
			$hash2 = password_hash($rehash, PASSWORD_DEFAULT);
			$new_line=$line_saved."\n".$_POST["e-mail"].",".$hash2.",".$t[2].",".$t[3].",".$t[4].",".$t[5]."\n";
			fwrite($fichier_end, $new_line);
			fclose($fichier_end);
			echo "Vos modification ont bien été prise en compte";

		}
	}
}


?>

<footer id='bas'>
   <p>Copyright © Wasef Alexandra</p> 
</footer>
</div>
</body>
</html>