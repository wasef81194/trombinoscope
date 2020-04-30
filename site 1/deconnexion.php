<?php
session_start();
unset($_SESSION["login"]);
unset($_SESSION['password']);
unset($_SESSION['nom']);
unset($_SESSION['prenom']);
unset($_SESSION['filiere']);
unset($_SESSION['groupe']);
unset($_SESSION['photo']);
session_destroy();
header('Location: index.php');
exit();
  
?>