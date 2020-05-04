<?php
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
function TrieEtu ($filiere,$groupe){
	$fichier = "./noacess/document.csv";
	$lines = file($fichier);
	header('content-type:application/json');
	$data = array();
	$l=0;
		for($i=0;$i<sizeof($lines);$i++){	
			$line = $lines[$i];
			# remove new line character
			$line = str_replace("\n","",$line);
			$t = explode(",", $line);
			//echo $t[0];
			if($t[4]==$filiere){
				$data["filiere"]  = $filiere;
				if($t[5]==$groupe){
					$data["groupe"]  = $groupe;
					$data["eleve"][$l]= array();
					$data["eleve"][$l]["nom"] = $t[2];
					$data["eleve"][$l]["prenom"] = $t[3];
					$data["eleve"][$l]["mail"] = $t[0];
					$data["eleve"][$l]["picture"] =  "http://trombinoscope-api.alwaysdata.net/".$t[6];
					$l=$l+1;
					
				}
			}
		}
		$donnee = json_encode($data,True);
		return $donnee;
}
function TrieEtuFiliere ($filiere){
	$fichier = "./noacess/document.csv";
	$lines = file($fichier);
	header('content-type:application/json');
	$data = array();
	$l=0;
		for($i=0;$i<sizeof($lines);$i++){
			$line = $lines[$i];
			# remove new line character
			$line = str_replace("\n","",$line);
			$t = explode(",", $line);
			//echo $t[0];
			if($t[4]==$filiere){
				$data["filiere"]  = $filiere;
				$data["eleve"][$l]= array();
				$data["eleve"][$l]["nom"] = $t[2];
				$data["eleve"][$l]["prenom"] = $t[3];
				$data["eleve"][$l]["mail"] = $t[0];
				$data["eleve"][$l]["groupe"] = $t[5];
				$data["eleve"][$l]["picture"] =  "http://trombinoscope-api.alwaysdata.net/".$t[6];
				$l=$l+1;		
			}
		}
		$donnee = json_encode($data,True);
		return $donnee;
}

function VerifyKeys($keys){
	$fichier = "./noacess/keys.csv";
		$KeysExist = FALSE;
		$lines = file($fichier);
			for($i=0;$i<sizeof($lines);$i++){	
				$line = $lines[$i];
				# remove new line character
				$line = str_replace("\n","",$line);
				$t = explode(",", $line);
				if ($t[1] == $keys){
					$KeysExist = TRUE;
				}
			}
		return $KeysExist;
}

function CountFile($date,$heure,$cle){
	$fichier = fopen('./compteur/'.$date.'_'.$heure.'_'.$cle.'.txt','c+' ); //c+ permet d'ouvrir le fichier pour lecture et écriture mais n'écrase pas le fichier si il existe
	$count = intval(fgets($fichier));//intval = int
	$count++;
	fseek($fichier, 0);//remet le pointeur au début du fichier
	fputs($fichier,$count);
	fclose($fichier);
	return $count;
}

$heure = date("H");
$date = date("Y-m-d");
if (isset($_GET['filiere']) and isset($_GET['groupe']) and isset($_GET['key']) and VerifyKeys($_GET['key'])==TRUE){
	if (CountFile($date,$heure,$_GET['key'])<150) {
		echo TrieEtu ($_GET['filiere'],$_GET['groupe']);//http://trombinoscope-api.alwaysdata.net/data.php?filiere=LPI&groupe=L1&key=pHQxXMN1nO 2pHAL4FSFx
	}
	else{
		echo " Vous avez atteint le nombre maximal d'utilisation de votre clé réesayer dans une heure";
	}
}
elseif (isset($_GET['filiere']) and isset($_GET['key']) and VerifyKeys($_GET['key'])==TRUE) {
	if (CountFile($date,$heure,$_GET['key'])<150) {
		echo TrieEtuFiliere ($_GET['filiere']);//http://trombinoscope-api.alwaysdata.net/data.php?filiere=MIPI&key=pHQxXMN1nO 
	}
	else{
		echo " Vous avez atteint le nombre maximal d'utilisation de votre clé réesayer dans une heure";
	}
}
elseif (isset($_GET['requete']) and isset($_GET['key']) and VerifyKeys($_GET['key'])==TRUE) {
	if (CountFile($date,$heure,$_GET['key'])<150) {	
		header('content-type:application/json');
		if($_GET['requete']=="filiere"){
			readfile("filiere.json");//http://trombinoscope-api.alwaysdata.net/data.php?requete=filiere&key=pHQxXMN1nO 
		}
	}
	else{
		echo " Vous avez atteint le nombre maximal d'utilisation de votre clé réesayer dans une heure";
	}
}
else{
	echo " Erreur votre url n'est pas conforme";
}

?>