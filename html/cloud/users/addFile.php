<?php
	if(!empty($_GET['username']) && isset($_FILES['file'])) {

		$tmpname = $_FILES['file']['tmp_name'];
		$destination = $_GET['username'].'/'.$_FILES['file']['name'];
		move_uploaded_file($tmpname , $destination);
	} else if(empty($_GET['username'])) {
		echo "Nom d'utilisateur manquant.\n";
	} else {
		echo "Fichier manquant.\n";
	}
?>
