<?php
//127.0.0.1:8080/users/addUser.php?username=superTest&password=superTest&group=moderator
	
	
	$userToDelete=$_GET['username'];
	if(isset($userToDelete)) {

		// On supprime l'utilisateur du groupe
		$group = file_get_contents("../../groups");
		$group = str_replace($userToDelete.' ', '', $group);


		// On écrase le fichier groups
		if(!file_put_contents('../../groups' , $group)) {
			echo "Erreur d'écriture\n";
			return 0;
	
		// On passe au fichier users
		} else {
			$user = file_get_contents("../../users");
			preg_match('/'.$userToDelete.':.*\n/', $user, $match);
			$lineToDelete = $match[0];
			$user = str_replace($lineToDelete, '', $user);

			// On écrase le fichier users
			if(!file_put_contents('../../users' , $user)) {
				echo "Erreur d'écriture\n";
				return 0;
	
			// On passe au dossier de l'utilisateur
			} else {
				$rmDir = "rm -rf ".$userToDelete;
				exec($rmDir);
			}
		}

		
	} else {
		echo "Argument manquant\n";
	}
?>
