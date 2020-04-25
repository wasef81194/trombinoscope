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
	<p>	<input type="text" name="nom" value="<?php 
	if(isset($_POST['nom'])){
		echo $_POST['nom'];
	}
	else{
		echo $_SESSION['nom']; 
	}
	?>" /></p>
	<p> Entrer votre Prénom : </p>
	<p>
	<input type="text" name="prenom" value="<?php
	if(isset($_POST['prenom'])){
		echo $_POST['prenom'];
	}
	else{
		echo $_SESSION['prenom']; 
	} ?>" /></p>
	<select name="filiere">
    	<option name ='f1' >MIPI</option>
    	<option name ='f2' >LPI</option>
    	<option name ='f3' >Licence de Droit</option>
    	<option name ='f4' >Licence des Arts</option>
    </select>
    <p>Entrer votre groupe :</p>
    <select name="groupe">
    	<option name ='g1' >L1</option>
    	<option name ='g2' >L2</option>
    	<option name ='g3' >L3</option>
    </select>
	</p>
	<input type="hidden" name="formtype" value="connexion" />
	</p>
	<p>
	<input type="submit" value="valider"/>

	<input type="reset" value="recommancer"/>
	</p>
</div>
</form>

<?php
//function modification(){}
$fichier = "document.csv";
//echo "SALUTTTT";
//echo $_POST["e-mail"];



//echo "SALUTTTT";
$lines = file($fichier);
$line_saved ='';
for($i=0;$i<sizeof($lines);$i++){	
	$line = $lines[$i];
	# remove new line character
	//$line = str_replace("\n","",$line);
	$t = explode(",", $line);
	$new_line = $t[0].",".$t[1].",".$_POST["nom"].",".$_POST["prenom"].",".$_POST["filiere"].",".$_POST["groupe"]."\n";
	if (isset($_POST["prenom"]) and isset($_POST["nom"])){
		if ($t[0] != $_SESSION['login']){
			$line_saved = $line_saved.$line;
			$content = $line_saved;
			//echo $line_saved;
	}

		elseif( $t[2] != $_POST["nom"] or $t[3] != $_POST["prenom"] or $t[4] != $_POST["filiere"] or $t[5] != $_POST["groupe"]){
			$fichier_end = fopen($fichier,"w");
			$content=$content.$new_line;
			fwrite($fichier_end, $content);
			fclose($fichier_end);
			$_SESSION['nom']= $_POST["nom"];
			$_SESSION['prenom']=$_POST["prenom"];
			$_SESSION['filiere']=$_POST["filiere"];
			$_SESSION['groupe']=$_POST["groupe"];
			echo "Vos modification ont bien été prise en compte";
		}
		else{
			echo " Erreur";
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