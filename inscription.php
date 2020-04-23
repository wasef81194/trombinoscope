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
<form action="./process.php" method="post">
	<h2 id="resu">Inscription </h2>
	<div id="inscription">
	<p>Entrer votre mail:</p>
	<input type="e-mail" name="email"/></p>
	<p> Entrer votre mot de passe :</p>
	<p>
	<input type="password" name="passwordi"/></p>
	<p> Verification de votre mot de passe :</p>
	<p>
	<input type="password" name="verification"/>
	<input type="hidden" name="formtype" value="inscription" />
	</p>

	<p>
	<input type="submit" value="valider"/>

	<input type="reset" value="recommancer"/>
	</p>
</div>
</form>
<a href=index.php>Connesxion</a>
<footer id='haut'>
    <p>Copyright © Wasef Alexandra</p>
</footer>
</div>
</body>
</html>