<?php
	if(!empty($_GET['username']) && !empty($_GET['filename'])) {
	
		$deletedFile = $_GET['username'].'/'.$_GET['filename'];
		if(!file_exists($deletedFile)) {
			echo "Fichier non trouvé.\n";
		} else {
			unlink($deletedFile);
		}
	} else if(empty($_GET['username'])) {
		echo "Nom d'utilisateur manquant.\n";
	} else {
		echo "Nom de fichier manquant.\n";
	}
?>
