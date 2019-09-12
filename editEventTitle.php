<?php

require_once('bdd.php');

if (isset($_POST['delete']) && isset($_POST['id'])){
	
	$id = "";
	
	$id = test_input($_POST['id']);
	
	$sql = "DELETE FROM events WHERE id = $id";
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Error prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}
	
}elseif (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['color']) && isset($_POST['id'])){
	
	$id = $title = $description = $color = "";
	
	$id = test_input($_POST['id']);
	$title = test_input($_POST['title']);
	$description = test_input($_POST['description']);
	$color = test_input($_POST['color']);
	
	$sql = "UPDATE events SET  title = '$title', description = '$description', color = '$color' WHERE id = $id ";

	
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
header('Location: index.php');

	
?>
