<?php

// Connexion à la base de données
require_once('bdd.php');

//echo $_POST['title'];
if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
	
	$title = $description = $start = $end = $color = "";
	
	$title = test_input($_POST['title']);
	$description = test_input($_POST['description']);
	$start = test_input($_POST['start']);
	$end = test_input($_POST['end']);
	$color = test_input($_POST['color']);

	$sql = "INSERT INTO events(title, description, start, end, color) values ('$title', '$description', '$start', '$end', '$color')";
	//$req = $bdd->prepare($sql);
	//$req->execute();
	
	echo $sql;
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Error prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}

}
header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
