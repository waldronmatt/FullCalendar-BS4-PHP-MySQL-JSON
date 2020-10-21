<?php
require_once('auth.php');
require_once('sanitize.php');

if (isset($_POST['title'])) {
	$title = sanitizeInput($_POST['title']);
	$description = sanitizeInput($_POST['description']);
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = sanitizeInput($_POST['color']);

	$sql = "INSERT INTO events(title, description, start, end, color) values ('$title', '$description', '$start', '$end', '$color')";
	echo $sql;
	
	$prepareQuery = $auth->prepare($sql);

	if ($prepareQuery == false) {
	 print_r($auth->errorInfo());
	 die ('Error preparing the query.');
	}

	$executeQuery = $prepareQuery->execute();

	if ($executeQuery == false) {
	 print_r($prepareQuery->errorInfo());
	 die ('Error executing the query');
	}
}

header('Location: '.$_SERVER['HTTP_REFERER']);
?>
