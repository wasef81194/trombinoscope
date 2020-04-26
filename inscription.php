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
<form action="./process.php" method="post" enctype="multipart/form-data" type="inscription" class="inscription">
	<h2 id="resu">Inscription </h2>
	<div id="inscription">
	<p>Entrer votre Nom:</p>
	<input type="e-mail" name="nom"/></p>
	<p>Entrer votre Prénom:</p>
	<input type="e-mail" name="prenom"/></p>
	<p>Entrer votre fillière:</p>
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
	<p>Entrer votre mail:</p>
	<input type="e-mail" name="email"/></p>
	<p> Entrer votre mot de passe :</p>
	<p>
	<input type="password" name="passwordi"/></p>
	<p> Verification de votre mot de passe :</p>
	<p>
	<input type="password" name="verification"/>
	<p> Saissiez votre photo de profil :</p>
	<p><input type="file" name="avatar" /></p>
	<input type="hidden" name="formtype" value="inscription" />
	<input type="submit" value="valider" class="button" />

	<input type="reset" value="recommancer" class="button" />
	<p>Vous avez déja un compte ?
	<a href=index.php>cliquez ici pour vous connectez</a></p>
	</p>
</div>
</form>
<footer id='haut'>
    <p>Copyright © Wasef Alexandra</p>
</footer>
</div>
</body>
</html>