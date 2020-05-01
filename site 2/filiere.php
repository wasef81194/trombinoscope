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
      <p>© Wasef Alexandra</p>
      </ul>
        <a class ="bottom"href="deconnexion.php">Déconnexion</a>
      </ul> 
    </nav>
<div class="main">
	<h1>Trombinoscope</h1>
	<h2>Eleves par filiere</h2>
	<?php
	if(isset($_GET['filiere'])){
		$recup_data = file_get_contents('http://trombinoscope-api.alwaysdata.net/data.php?filiere='.$_GET['filiere'].'&key=pHQxXMN1nO');
		$data = json_decode($recup_data,true);
		//var_dump($data);
		$number = count($data["eleve"]);
		for ($i=0; $i <$number ; $i++) {
				echo "<div class='card'>";
					echo "<img src=".$data["eleve"][$i]['picture'].">";
					echo "<div class='container'>";
						echo "<p> Nom : ".$data["eleve"][$i]['nom']."  ".$data["eleve"][$i]['prenom']."</p>";
						echo "<p> Mail : ".$data["eleve"][$i]['mail']."</p>";
						echo "<p> Groupe : ".$data["eleve"][$i]['groupe']."</p>";
					echo"</div>";
				echo "</div>";	
		}
		
	}


?>



</div>
</body>
</html>