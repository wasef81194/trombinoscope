<?php
session_start();

$fichier = "document.csv";
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
        
        elseif( $t[2] != $_POST["nom"] or $t[3] != $_POST["prenom"] or $t[4] != $_POST["filiere"] or $t[5] != $_POST["groupe"] or isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
            {
            if (isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
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
                        $n_line = $t[0].",".$t[1].",".$_POST["nom"].",".$_POST["prenom"].",".$_POST["filiere"].",".$_POST["groupe"].",".$chemin;
                        $content=$content.$n_line;
                        fwrite($fichier_end, $content);
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
            else{
                $fichier_end = fopen($fichier,"w");
                $content=$content.$new_line;
                fwrite($fichier_end, $content);
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
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <title>Trombinoscope-API</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
<body>
    <div  id="carte">
    <div class="navbar">
                <h1>Trombinoscope-API</h1>
                <a href="deconnexion.php">Déconnexion</a>
                <a href="api.php">API</a>
                <a href="acceuil.php">Acceuil</a>
                
    </div>

<form action="./edit.php" method="post" class="modification" enctype="multipart/form-data">
    <h2 id="res">Modification </h2>
    <?php  
    if (isset($message)){
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
        <option name="f"><?php echo $_SESSION['filiere']?></option>
        <option name ='f1' >MIPI</option>
        <option name ='f2' >LPI</option>
        <option name ='f3' >LI</option>
        <option name ='f4' >LPI-RIWS</option>
        <option name ='f5' >LPI RS</option>
    </select>
    <p>Entrer votre groupe :</p>
    <select name="groupe">
        <option name="g"><?php echo $_SESSION['groupe']?></option>
        <option name ='g1' >L1</option>
        <option name ='g2' >L2</option>
        <option name ='g3' >L3</option>
    </select>
    <p> Saissiez votre photo de profil :</p>
    <p><input type="file" name="avatar" /></p>
    </p>
    <input type="hidden" name="formtype" value="connexion" />
    </p>
    <p>
    <input type="submit" value="valider" class="button" />

    <input type="reset" value="recommancer" class="button" />

    </p>
</form>

<?php

?>

<footer id='bas'>
   <p>Copyright © Wasef Alexandra</p> 
</footer>
</div>
</body>
</html>