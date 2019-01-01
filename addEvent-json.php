<?php

//echo $_POST['title'];
if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
	
$jsonString = file_get_contents('json/events.json');
$data = json_decode($jsonString, true);

$last_item    = end($data);
$last_item_id = $last_item['id'];

				$start = explode(" ", $_POST['start']);
				$end = explode(" ", $_POST['end']);
				if($start[1] == '00:00:00'){
					$_POST['start'] = $start[0];
				}
				if($end[1] == '00:00:00'){
					$_POST['end'] = $end[0];
				}


$extra = array(
'id' => ++$last_item_id,
'title' => $_POST['title'],
'description' => $_POST['description'],
'start' => $_POST['start'],
'end' => $_POST['end'],
'color' => $_POST['color'],
);

$data[] = $extra;

$newJsonString = json_encode($data);
file_put_contents('json/events.json', $newJsonString);

}
header('Location: '.$_SERVER['HTTP_REFERER']);
	
?>

