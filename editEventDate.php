<?php

// Connexion à la base de données
require_once('bdd.php');

if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){
	
	$id = $start = $end = "";
	
	$id = test_input($_POST['Event'][0]);
	$start = test_input($_POST['Event'][1]);
	$end = test_input($_POST['Event'][2]);

	$sql = "UPDATE events SET  start = '$start', end = '$end' WHERE id = $id ";
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Error prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}else{
		die ('OK');
	}

}
//header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
