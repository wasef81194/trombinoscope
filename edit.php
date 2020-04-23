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

<form action="./modification.php" method="post">
    <h2 id="res">Modification </h2>
    <div id="modification">
    <p> Entrer votre Nom : </p>
	<p>
	<input type="text" name="login"/></p>
	<p> Entrer votre Prénom : </p>
	<p>
	<input type="text" name="login"/></p>
	<p> Entrer votre email : </p>
	<p>
	<input type="e-mail" name="login"/></p>
	<p> Entrer votre mot de passe :</p>
	<p>
	<input type="password" name="password"/>
	<input type="hidden" name="formtype" value="connexion" />
	</p>
	<p>
	<input type="submit" value="valider"/>

	<input type="reset" value="recommancer"/>
	</p>
</div>
</form>


<footer id='bas'>
   <p>Copyright © Wasef Alexandra</p> 
</footer>
</div>
</body>
</html>