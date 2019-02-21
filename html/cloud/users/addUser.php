<?php
//127.0.0.1:8080/users/addUser.php?username=superTest&password=superTest&group=moderator

	if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['group'])) {

		$group = file_get_contents("../../groups");

		switch($_POST['group']) {
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

		$position = strpos($group, $_POST['group']);
		if($position >= 0) {
			// On réécrit le fichier group
			$position += $caracteres;
			$group = substr_replace ($group , $_POST['username'].' ' , $position, 0);

			if(!file_put_contents('../../groups' , $group)) {
				echo "Erreur d'écriture\n";
				return 0;
			} else {
				$htPasswd = "htpasswd -b ../../users  ".$_POST['username']." ".$_POST['password'];
				exec($htPasswd);
				$mkDir = "mkdir ".$_POST['username'];
				exec($mkDir);
			}
			
		} else {
			echo "Groupe inconnu : ".$_POST['group']."\n";
			return 0;
		}
	} else {
		echo "Argument(s) manquant(s)\n";
	}
?>
