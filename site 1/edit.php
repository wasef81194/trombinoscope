<?php
session_start();
//Fonction qui enregistre les connexion de cette page heurodaté
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

if (isset($_SESSION['login'])) {
$fichier = "./noacess/document.csv";
//fonction qui enregistre toute les lignes du fichier qui ne corespondent pas a la session ouverte
function save($fichier){
    $lines = file($fichier);
    $line_saved ='';
    for($i=0;$i<sizeof($lines);$i++){   
        $line = $lines[$i];
        $t = explode(",", $line);
         if ($t[0] != $_SESSION['login']){ 
            $line_saved = $line_saved.$line;
            $content = $line_saved;
        }
    }
    return $content;
}
$lines = file($fichier);
$line_saved ='';
$content = save($fichier);

for($i=0;$i<sizeof($lines);$i++){   
    $line = $lines[$i];
    # remove new line character
    //$line = str_replace("\n","",$line);
    $t = explode(",", $line);
    $new_line = $t[0].",".$t[1].",".$_POST["nom"].",".$_POST["prenom"].",".$_POST["filiere"].",".$_POST["groupe"].",".$t[6];

    if (isset($_POST["prenom"]) and isset($_POST["nom"])){
        if ($t[0] != $_SESSION['login']){ 
            $content = save($fichier);
           }
        
        elseif( $t[2] != $_POST["nom"] or $t[3] != $_POST["prenom"] or $t[4] != $_POST["filiere"] or $t[5] != $_POST["groupe"] or isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))//si l'utilisateur a effectuer des modification
        {
            if (isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))//si l'utilisateur modifie sa photo
            {
                $tailleMax = 2097152;
                $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
                if($_FILES['avatar']['size'] <= $tailleMax)
                {
                    $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
                    if(in_array($extensionUpload, $extensionsValides))
                	{       
                        $chemin = "photo/".$t[0].".".$extensionUpload;
                        $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                        $fichier_end = fopen($fichier,"w");
                        $n_line = $t[0].",".$t[1].",".$_POST["nom"].",".$_POST["prenom"].",".$_POST["filiere"].",".$_POST["groupe"].",".$chemin."\n";
                        $line_saved= $line_saved.$content.$n_line;
                        fwrite($fichier_end, $line_saved);
                        fclose($fichier_end);
                        $_SESSION['photo']= $chemin;
                        $message = "Vos modification ont bien été prise en compte";
                    }
                    else
                    {
                        $message_erreur = "Votre photo de profil doit être au format jpg, jpeg, gif ou png ";
                    }
                }   
                else
                {
                    $message_erreur = "Votre photo de profil ne doit pas dépasser 2Mo ";
                }
            }
            else{//si l'utilisateur modifie des élement de son profil autre que la photo
                $fichier_end = fopen($fichier,"w");
                $line_saved= $line_saved.$content.$new_line;
                fwrite($fichier_end, $line_saved);
                fclose($fichier_end);
                $_SESSION['nom']= $_POST["nom"];
                $_SESSION['prenom']=$_POST["prenom"];
                $_SESSION['filiere']=$_POST["filiere"];
                $_SESSION['groupe']=$_POST["groupe"];
                $message = "Vos modification ont bien été prise en compte";
                }
        }
        else{
            $message_erreur = " Aucune modification n'a été faite";
        }

    }
    }
?>
<!DOCTYPE html>
<html lang="fr">
		<head>
   			 <meta charset="utf-8">
			<title>Trombinoscope-API</title>
			<link rel="stylesheet" type="text/css" href="css/style.css">
		</head>
<body>
    <div class="navbar">
                <h1>Trombinoscope-API</h1>
                <a href="deconnexion.php">Déconnexion</a>
                <a href="api.php"> Cle API</a>
                <a href="acceuil.php">Profil</a>
                <a href="index.php">Documentation</a>
                
    </div>

<form action="./edit.php" method="post" class="modification" enctype="multipart/form-data">
    <h2 id="res">Modification </h2>
    <?php  
    if (isset($message)){//affiche le message
        echo '<div id="message">'.$message."</div>";
    }
    else{
        echo "<div id='message_erreur'>".$message_erreur."</div>";
    }
     ?>
    <p> Entrer votre Nom : </p>
    <p> <input type="text" name="nom" value="<?php 
        echo $_SESSION['nom'];
    ?>" /></p>
    <p> Entrer votre Prénom : </p>
    <p>
    <input type="text" name="prenom" value="<?php
        echo $_SESSION['prenom'];
         ?>" /></p>
    <p>Entrer votre filière :</p>
    <select name="filiere">
        <option id="f"><?php echo $_SESSION['filiere']?></option>
        <option id ='f1' >MIPI</option>
        <option id ='f2' >LPI</option>
        <option id ='f4' >LPI-RIWS</option>
        <option id ='f5' >LPI-RS</option>
    </select>
    <p>Entrer votre groupe :</p>
    <select name="groupe">
        <option id="g"><?php echo $_SESSION['groupe']?></option>
        <option id ='g1' >L1</option>
        <option id ='g2' >L2</option>
        <option id ='g3' >L3</option>
    </select>
    <p> Saissiez votre photo de profil :</p>
    <p><input type="file" name="avatar" /></p>
    <input type="hidden" name="formtype" value="modification" />
    <p>
    <input type="submit" value="valider" class="button" />

    <input type="reset" value="recommancer" class="button" />

    </p>
</form>

<?php
//fonction qui permet de savoir si l'utilisateur a modifier son profil
function logsEdit(){
  $date = "[".date('d')."/".date('m')."/".date('y')."] ";
  $hour = "[".date('H').":".date('i').":".date('s')."] ";
  $ip = $_SERVER['REMOTE_ADDR'];
  $url = $_SERVER['PHP_SELF'];
  $answer = $date.$hour.$ip." modify his profile \n";

  $files = fopen('./noacess/logs.txt', 'a+');
  fputs($files,$answer);
  fclose($files);
}

if (isset($message)){
        logsEdit();
    } 
?>

<footer id='bas'>
   <p>Copyright © Wasef Alexandra</p> 
</footer>
</div>
</body>
</html>
<?php
}
else{
    header('Location: connexion.php');
} 
?>