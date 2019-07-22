<?php

//echo $_POST['title'];
if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){

    $jsonString = file_get_contents('json/events.json');
    $data = json_decode($jsonString, true);

    $last_item    = end($data);
    $last_item_id = $last_item['id'];
    $last_item_rid = $last_item['rid'];
    
    $start = explode(" ", $_POST['start']);
    $end = explode(" ", $_POST['end']);
    if($start[1] == '00:00:00') {
        $_POST['start'] = $start[0];
    }
    if($end[1] == '00:00:00') {
        $_POST['end'] = $end[0];
    }
    
        for ($x = 0; $x < $_POST['count']; $x++) {
            if ($x > 0) {
                $start[0] = date('Y-m-d', strtotime($start[0] . " + 7 day"));
                $_POST['start'] = $start[0] . " " . $start[1];
                $end[0] = date('Y-m-d', strtotime($end[0] . " + 7 day"));
                $_POST['end'] = $end[0] . " " . $end[1];
                if($start[1] == '00:00:00') {
                    $_POST['start'] = $start[0];
                }
                if($end[1] == '00:00:00') {
                    $_POST['end'] = $end[0];
                }
            }
            $extra = array(
                'id' => ++$last_item_id,
                'rid' => $last_item_rid+1,
                'repeat' => $_POST['repeat'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'start' => $_POST['start'],
                'end' =>  $_POST['end'],
                'color' => $_POST['color'],
            );
            $data[] = $extra;
            $newJsonString = json_encode($data);
            file_put_contents('json/events.json', $newJsonString);
        }
}
header('Location: '.$_SERVER['HTTP_REFERER']);
	
?>

