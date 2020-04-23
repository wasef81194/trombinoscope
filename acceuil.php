<?php
session_start();
echo'<html>
		<head>
   			 <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
			<title>Trombinoscope-API</title>
			<link rel="stylesheet" type="text/css" href="css/style.css">
		</head>
		<body>
			<div  id="carte">
			<h1>Trombinoscope-API</h1>';
echo "<div='edit'>";
echo "nom = ".$_SESSION['login'];
echo "mdp = ".$_SESSION['password'];

echo"</div>"
?>
<p id ='bouton_edit'><a href=edit.php>Edit</a></p>
<footer id='bas'>
   <p>Copyright © Wasef Alexandra</p> 
</footer>
</div>
</body>
</html>
