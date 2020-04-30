<?php
session_start();
echo'<html>
		<head>
   			 <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
			<title>Trombinoscope-API</title>
			<link rel="stylesheet" type="text/css" href="css/style.css">
		</head>
		<body>
			<div class="navbar">
                <h1>Trombinoscope-API</h1>
                <a href="deconnexion.php">Déconnexion</a>
                <a href="api.php">API</a>
                <a href="acceuil.php">Acceuil</a>
                
    </div>
			';
echo "<div id='avatar'>
	<h2>Profil</h2>";
echo " <p> E-mail : ".$_SESSION['login']."</p>";
echo "<p>Nom : ".$_SESSION['nom']."</p>";
echo "<p>Prenom : ".$_SESSION['prenom']."</p>";
echo "<p>Filiere : ".$_SESSION['filiere']."</p>";
echo "<p> Groupe : ".$_SESSION['groupe']."</p>";
//echo "<p>mdp = ".$_SESSION['password']."</p>";
echo "<img src=".$_SESSION['photo'].">";
?>

<p><a class="button_" href=edit.php> Modifier </a></div>
<footer id='bas'>
   <p>Copyright © Wasef Alexandra</p> 
</footer>
</div>
</body>
</html>
