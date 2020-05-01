<?php
session_start();
// voir les filiere du département informatique
//voir les une filiere specifies
//voir un groupe de filiere 

?>
<html>
	<head>
   		<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
		<title>Trombinoscope</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<nav>
    <ul>
    <a href="acceuil.php">Acceuil</a>  
    <li><a href="filiere.php?filiere=MIPI&key=pHQxXMN1nO">MIPI</a></li>
      <ul>
      <li><a href="groupe.php?filiere=MIPI&groupe=L1&key=pHQxXMN1nO">MIPI-L1</a></li>
      <li><a href="groupe.php?filiere=MIPI&groupe=L2&key=pHQxXMN1nO">MIPI-L2</a></li>
      <li><a href="groupe.php?filiere=MIPI&groupe=L3&key=pHQxXMN1nO">MIPI-L3</a></li>
      </ul>
    <li><a href="filiere.php?filiere=LPI&key=pHQxXMN1nO">LPI</a></li>
      <ul>
      <li><a href="groupe.php?filiere=LPI&groupe=L1&key=pHQxXMN1nO">LPI-L1</a></li>
      <li><a href="groupe.php?filiere=LPI&groupe=L2&key=pHQxXMN1nO">LPI-L2</a></li>
      <li><a href="groupe.php?filiere=LPI&groupe=L3&key=pHQxXMN1nO">LPI-L3</a></li>
      </ul>
    <li><a href="filiere.php?filiere=LPI-RIWS&key=pHQxXMN1nO">LPI-RIWS</a></li>
      <ul>
      <li><a href="groupe.php?filiere=LPI-RIWS&groupe=L1&key=pHQxXMN1nO">LPI-RIWS-L1</a></li>
      <li><a href="groupe.php?filiere=LPI-RIWS&groupe=L2&key=pHQxXMN1nO">LPI-RIWS-L2</a></li>
      <li><a href="groupe.php?filiere=LPI-RIWS&groupe=L3&key=pHQxXMN1nO">LPI-RIWS-L3</a></li>
      </ul>
    <li><a href="filiere.php?filiere=LPI-RS&key=pHQxXMN1nO">LPI-RS</a></li>
      <ul>
      <a href="groupe.php?filiere=LPI-RS&groupe=L1&key=pHQxXMN1nO">LPI-RS-L1</a></li>
      <a href="groupe.php?filiere=LPI-RS&groupe=L2&key=pHQxXMN1nO">LPI-RS-L2</a></li>
      <a href="groupe.php?filiere=LPI-RS&groupe=L3&key=pHQxXMN1nO">LPI-RS-L3</a></li>
      </ul>
         <a href="deconnexion.php">Déconnexion</a>
         <p>© Wasef Alexandra</p>
      </ul> 
    </nav>

<div class="main">

<h1>Trombinoscope</h1>
<h2>Bienvenu <?php echo $_SESSION['login'] ?></h2>
<div id='center'>
<p id="bas">Découvrez la liste des filieres présente dans le départment informatique de notre établissement :</p>
</div>
<table>

   <tr>
       <th>Filiere</th>
       <th>Première année</th>
       <th>Deuxieme année</th>
       <th>Troisième année</th>

   </tr>
<?php 
$recup_data = file_get_contents('http://trombinoscope-api.alwaysdata.net/data.php?requete=filiere&key=pHQxXMN1nO');
$data = json_decode($recup_data,true);
//var_dump($data);
for ($i=0; $i < 4 ; $i++) { 
	echo "
   <tr>
    <td>".$data["NomDesFilieres"]["$i"]["Filiere"]."</td>
    <td>".$data["NomDesFilieres"]["$i"]["groupes"][0]."</td>
    <td>".$data["NomDesFilieres"]["$i"]["groupes"][1]."</td>
    <td>".$data["NomDesFilieres"]["$i"]["groupes"][2]."</td>
   </tr>
";
	//echo $data["NomDesFilieres"]["$i"]["Filiere"]."\n";
}

?>
</table>
<?php
if (isset($_COOKIE["LastRequestFiliere"]) and isset($_COOKIE["LastRequestGroup"])) {
	echo "
	<div id='center'>
		<a class='boutton' href='groupe.php?filiere=".$_COOKIE["LastRequestFiliere"]."&groupe=".$_COOKIE["LastRequestGroup"]."&key=pHQxXMN1nO'>Derniere requete </a>
	</div>	";
}
?>
</div>
</body>
</html>
