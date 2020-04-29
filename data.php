<?php
function TrieEtu ($filiere,$groupe){
	$fichier = "document.csv";
	$lines = file($fichier);
	header('content-type:application/json');
	$data = array();
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
					$data["eleve"][$i]= array();
					$data["eleve"][$i]["nom"] = $t[2];
					$data["eleve"][$i]["prenom"] = $t[3];
					$data["eleve"][$i]["mail"] = $t[0];
					$data["eleve"][$i]["picture"] =  "http://trombinoscope-api.alwaysdata.net/".$t[6];
					
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
		for($i=0;$i<sizeof($lines);$i++){	
			$line = $lines[$i];
			# remove new line character
			$line = str_replace("\n","",$line);
			$t = explode(",", $line);
			//echo $t[0];
			if($t[4]==$filiere){
				$data["filiere"]  = $filiere;
				$data["eleve"][$i]= array();
				$data["eleve"][$i]["nom"] = $t[2];
				$data["eleve"][$i]["prenom"] = $t[3];
				$data["eleve"][$i]["mail"] = $t[0];
				$data["eleve"][$i]["groupe"] = $t[5];
				$data["eleve"][$i]["picture"] =  "http://trombinoscope-api.alwaysdata.net/".$t[6];
					
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
			echo TrieEtu ($_GET['filiere'],$_GET['groupe']);//http://trombinoscope-api.alwaysdata.net/data.php?filiere=LPI&groupe=L1&key=jBw9rlmt43
	}
elseif (isset($_GET['filiere']) and isset($_GET['key']) and VerifyKeys($_GET['key'])==TRUE) {
	echo TrieEtuFiliere ($_GET['filiere']);//http://trombinoscope-api.alwaysdata.net/data.php?filiere=MIPI&key=jBw9rlmt43
}
elseif (isset($_GET['requete']) and isset($_GET['key']) and VerifyKeys($_GET['key'])==TRUE) {
	header('content-type:application/json');
	if($_GET['requete']=="filiere"){
		readfile("filiere.json");//http://trombinoscope-api.alwaysdata.net/data.php?requete=filiere&key=jBw9rlmt43
	}
}

?>