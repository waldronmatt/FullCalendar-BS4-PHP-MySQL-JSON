<?php

if (isset($_POST['delete']) && isset($_POST['id'])) {
	$jsonString = file_get_contents('json/events.json');
	$data = json_decode($jsonString, true);
	foreach ($data as $key => $entry) {
		if ($entry['id'] == $_POST['id']) {
            unset($data[$key]);
		}
	}
	$newJsonString = json_encode($data);
	file_put_contents('json/events.json', $newJsonString);
	
} else if (isset($_POST['delete-repeat']) && isset($_POST['rid'])) {
	$jsonString = file_get_contents('json/events.json');
	$data = json_decode($jsonString, true);
	foreach ($data as $key => $entry) {
		if ($entry['rid'] == $_POST['rid']) {
            unset($data[$key]);
		}
	}
	$newJsonString = json_encode($data);
	file_put_contents('json/events.json', $newJsonString);
	
} else if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['color']) && isset($_POST['id'])) {
	$jsonString = file_get_contents('json/events.json');
	$data = json_decode($jsonString, true);
    foreach ($data as $key => $entry) {
        if ($entry['id'] == $_POST['id']) {
            $data[$key]['title'] = $_POST['title'];
            $data[$key]['description'] = $_POST['description'];
            $data[$key]['color'] = $_POST['color'];
        }
    }
    $newJsonString = json_encode($data);
    file_put_contents('json/events.json', $newJsonString);

}
header('Location: index-json.php');

?>
