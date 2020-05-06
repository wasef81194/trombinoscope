<?php

//fonction qui tri les etudiant par filiere et groupe
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
unset($_SESSION["login"]);
unset($_SESSION['password']);
unset($_SESSION['nom']);
unset($_SESSION['prenom']);
unset($_SESSION['filiere']);
unset($_SESSION['groupe']);
unset($_SESSION['photo']);
session_destroy();
header('Location: connexion.php');
exit();
  
?>