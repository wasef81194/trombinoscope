<?php
session_start();
if (isset($_SESSION['login'])){// si la session existe tu affichage de la page si non redirect vers la page de connexion
setcookie("LastRequestFiliere",$_GET['filiere'],time()+3600);
setcookie("LastRequestGroup",$_GET['groupe'],time()+3600);
// voir les filiere du département informatique
//voir les une filiere specifies
//voir un groupe de filiere 
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
         <meta charset="utf-8">
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
  <div id='imprime'>
  <h2>Eleves de <?php echo $_GET['filiere']." en ". $_GET['groupe'] ?></h2>
  <?php
  if(isset($_GET['filiere'])and isset($_GET['groupe'])){
    $recup_data = file_get_contents('http://trombinoscope-api.alwaysdata.net/data.php?filiere='.$_GET['filiere'].'&groupe='.$_GET['groupe'].'&key=pHQxXMN1nO');
    $data = json_decode($recup_data,true);
    //var_dump($data);
    $number = count($data["eleve"]);
    for ($i=0; $i <$number ; $i++) {
        echo "<div class='card'>
                <div class='hide'>";
          echo "<img class='image' src=".$data["eleve"][$i]['picture'].">
                 <div class='middle'>";
          echo "<p class='text'> ".$data["eleve"][$i]['mail']."</p>
          </div>
          </div>";
          echo "<div class='container'>";
            echo "<p> ".$data["eleve"][$i]['nom']."  ".$data["eleve"][$i]['prenom']."</p>";
          echo"</div>";
        echo "</div>";  
    }
    
  }


?>
</div>
<script>
function printContent(element){
  var restorepage = document.body.innerHTML;
  var printcontent = document.getElementById(element).innerHTML;
  document.body.innerHTML = printcontent;
  window.print();
  document.body.innerHTML = restorepage;
}

</script>
<div id="center">
<button onclick="printContent('imprime')">Imprimer</button>
</div>


</div>
</body>
</html>
<?php
}
else{
  header('Location:index.php');
}
?>