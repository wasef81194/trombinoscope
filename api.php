<?php 
if (isset($_POST["formtype"])){
	$fichier = "keys.csv";

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
			}
		}

		if( $doesUserExist == TRUE ){
			$message_erreur = ($_POST["email"])." ce login est déjà pris";
		}
		else{
			echo "ok";
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
<form action="./api.php" method="post" enctype="multipart/form-data" type="api" class="cle_api">
	<h2 id="resu">Genrer une clé </h2>
	<?php  
    if (isset($message)){
        echo '<div id="message">'.$message."</div>";
    }
     ?>
	<p>Entrer votre mail:</p>
	<input type="e-mail" name="email"/></p>
	<input type="hidden" name="formtype" value="api" />
	<input type="submit" value="valider" class="button" />

</form>
<footer>
    <p>Copyright © Wasef Alexandra</p>
</footer>
</div>
</body>
</html>