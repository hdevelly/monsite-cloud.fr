<?php
//127.0.0.1:8080/users/addUser.php?username=superTest&password=superTest&group=moderator

	if(!empty($_GET['username']) && !empty($_GET['password']) && !empty($_GET['group'])) {

		$group = file_get_contents("../../groups");

		switch($_GET['group']) {
			case'administrator':
				$caracteres = 15;
				break;
			case'moderator':
				$caracteres = 11;
				break;
			case'user':
				$caracteres = 6;
				break;
		}

		$position = strpos($group, $_GET['group']);
		if($position >= 0) {
			// On réécrit le fichier group
			$position += $caracteres;
			$group = substr_replace ($group , $_GET['username'].' ' , $position, 0);

			if(!file_put_contents('../../groups' , $group)) {
				echo "Erreur d'écriture\n";
				return 0;
			} else {
				$htPasswd = "htpasswd -b ../../users  ".$_GET['username']." ".$_GET['password'];
				exec($htPasswd);
				$mkDir = "mkdir ".$_GET['username'];
				exec($mkDir);
			}
			
		} else {
			echo "Groupe inconnu : ".$_GET['group']."\n";
			return 0;
		}
	} else {
		echo "Argument(s) manquant(s)\n";
	}
?>
