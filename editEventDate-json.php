<?php

if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])) {
	$jsonString = file_get_contents('json/events.json');
	$data = json_decode($jsonString, true);

    $start = explode(" ", $_POST['Event'][1]);
    $end = explode(" ", $_POST['Event'][2]);
    if ($start[1] == '00:00:00') {
        $_POST['Event'][1] = $start[0];
    }
    if ($end[1] == '00:00:00') {
        $_POST['Event'][2] = $end[0];
    }
    
	foreach ($data as $key => $entry) {
	    if ($entry['id'] == $_POST['Event'][0]) {
            $data[$key]['start'] = $_POST['Event'][1];
            $data[$key]['end'] = $_POST['Event'][2];
		}
	}
	$newJsonString = json_encode($data);
	file_put_contents('json/events.json', $newJsonString);

}
//header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
