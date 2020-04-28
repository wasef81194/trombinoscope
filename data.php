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
					
				}
			}
		}
		$donnee = json_encode($data,True);
		return $donnee;
}


echo TrieEtu ("LPI","L1");

?>