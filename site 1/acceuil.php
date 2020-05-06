<?php 
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
session_start();
// si la session existe tu affichage de la page si non redirect vers la page de connexion
if (isset($_SESSION['login'])) {

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
                <a href="api.php">Cle API</a>
                <a href="acceuil.php">Profil</a>
                <a href="index.php">Documentation</a>
                
    </div>
			';
echo "<div id='avatar'>
	<h2>Profil</h2>";
echo " <div class='gras'> <p> E-mail : ".$_SESSION['login']."</p> ";
echo "<p>Nom : ".$_SESSION['nom']."</p>";
echo "<p>Prenom : ".$_SESSION['prenom']."</p>";
echo "<p>Filiere : ".$_SESSION['filiere']."</p>";
echo "<p> Groupe : ".$_SESSION['groupe']."</div></p>";
//echo "<p>mdp = ".$_SESSION['password']."</p>";
echo "<img src=".$_SESSION['photo'].">";

echo'
<p><a class="button_" href=edit.php> Modifier </a></div>
<footer>
   <p>Copyright © Wasef Alexandra</p> 
</footer>
</div>
</body>
</html>';
}
else{
	header('Location: connexion.php');
}
?>