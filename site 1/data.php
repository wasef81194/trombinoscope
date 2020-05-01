<?php
function TrieEtu ($filiere,$groupe){
	$fichier = "document.csv";
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
	$fichier = "document.csv";
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
	$fichier = "keys.csv";
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


if (isset($_GET['filiere']) and isset($_GET['groupe']) and isset($_GET['key']) and VerifyKeys($_GET['key'])==TRUE){
			echo TrieEtu ($_GET['filiere'],$_GET['groupe']);//http://trombinoscope-api.alwaysdata.net/data.php?filiere=LPI&groupe=L1&key=pHQxXMN1nO 
	}
elseif (isset($_GET['filiere']) and isset($_GET['key']) and VerifyKeys($_GET['key'])==TRUE) {
	echo TrieEtuFiliere ($_GET['filiere']);//http://trombinoscope-api.alwaysdata.net/data.php?filiere=MIPI&key=pHQxXMN1nO 
}
elseif (isset($_GET['requete']) and isset($_GET['key']) and VerifyKeys($_GET['key'])==TRUE) {
	header('content-type:application/json');
	if($_GET['requete']=="filiere"){
		readfile("filiere.json");//http://trombinoscope-api.alwaysdata.net/data.php?requete=filiere&key=pHQxXMN1nO 
	}
}
else{
	echo " Erreur votre url n'est pas conforme";
}

?>