<?php
	if(isset($argv[1]) && isset($argv[2]) && isset($argv[3])) {

		$group = file_get_contents("./groups");

		switch($argv[3]) {
			case'admin':
				$caracteres = 7;
				break;
			case'moderator':
				$caracteres = 11;
				break;
			case'user':
				$caracteres = 6;
				break;
		}

		$position = strpos($group, $argv[3]);

		if($position) {
			// On réécrit le fichier group
			$position += $caracteres;
			$group = substr_replace ($group , $argv[1].' ' , $position, 0);
			if(!file_put_contents ('./groups' , $group)) {
				echo "Erreur d'écriture\n";
				return 0;
			} else {
				$htPasswd = "htpasswd -b users  ".$argv[1]." ".$argv[2];
				exec($htPasswd);
				$mkDir = "mkdir cloud/users/".$argv[1];
				exec($mkDir);
			}
			
		} else {
			echo "Groupe inconnu : ".$argv[3]."\n";
			return 0;
		}
	} else {
		echo "Argument(s) manquant(s)\n";
	}
?>
