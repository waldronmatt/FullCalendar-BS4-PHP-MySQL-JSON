<?php

$jsonString = file_get_contents('../data/events.json');
$data = json_decode($jsonString, true);

if (isset($_POST['delete']) && isset($_POST['id'])) {
	foreach ($data as $key => $entry) {
		if ($entry['id'] == $_POST['id']) {
      unset($data[$key]);
		}
	}
	
} else if (isset($_POST['deleteRecurrence']) && isset($_POST['rid'])) {
	foreach ($data as $key => $entry) {
		if ($entry['rid'] == $_POST['rid']) {
      unset($data[$key]);
		}
	}
	
} else {
  foreach ($data as $key => $entry) {
    if ($entry['id'] == $_POST['id']) {
      $data[$key]['title'] = $_POST['title'];
      $data[$key]['description'] = $_POST['description'];
      $data[$key]['color'] = $_POST['color'];
    }
  }
}

$newJsonString = json_encode($data);
file_put_contents('../data/events.json', $newJsonString);

header('Location: ../index-json.php');
?>
