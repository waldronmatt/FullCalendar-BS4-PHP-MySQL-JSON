<?php 
// if post
if (isset($_POST['title'])){
    // weekday array
    $postDates = array(
        array('M',1,'monday'),
        array('T',2,'tuesday'),
        array('W',3,'wednesday'),
        array('R',4,'thursday'),
        array('F',5,'friday'),
        array('S',6,'saturday'),
        array('U',7,'sunday'),
    );
    // compute days in range
    function getDatesInRange($dateFromString, $dateToString, $dow, $dowNum) {
        $dateFrom = new \DateTime($dateFromString);
        $dateTo = new \DateTime($dateToString);
        // array of dates
        $dates = [];
        // return empty if dateFrom > dateTo
        if ($dateFrom > $dateTo) {
            return $dates;
        }
        // get next closest dow if dowNUM != dateFrom
        if ($dowNum != $dateFrom->format('N')) {
            $dateFrom->modify('next '. $dow);
        }
        // if dateFrom <= dateTo, modify by 1 week
        while ($dateFrom <= $dateTo) {
            $dates[] = $dateFrom->format('Y-m-d');
            $dateFrom->modify('+1 week');
        }
        return $dates;
    }

    // get date info
    $jsonString = file_get_contents('json/events.json');
    $data = json_decode($jsonString, true);
    // get, set id, rid
    $last_item = end($data);
    $last_item_id = $last_item['id'];
    $last_item_rid = $last_item['rid'];
    // split start, end into date, time
    $start = explode(" ", $_POST['start']);
    $end = explode(" ", $_POST['end']);

    // if event is recurrence
    if ($_POST['repeat'] == 'yes') {
        // initialize vars
        $dateFromString = $start[0];
        $endDate = $_POST['endDate'];
        $dateToString = $endDate;
        // for each dow
        foreach ($_POST['dowID'] as $key => $value) {
            // initialize vars
            $dowNum = $postDates[$value][1];
            $dow = $postDates[$value][2];
            // call days in range function
            $dates = getDatesInRange($dateFromString, $dateToString, $dow, $dowNum);
            // loop each day for dow
            $counter = count($dates);
            for ($x = 0; $x < $counter; $x++) {
                // date from array dates
                $date = $dates[$x];
                // set recurrence date, time for each date
                $_POST['start'] = $date . " " . $start[1];
                $_POST['end'] = $date . " " .  $end[1];
                // if all day event, set the date only
                if($start[1] == '00:00:00') {
                    $_POST['start'] = $date;
                }
                if($end[1] == '00:00:00') {
                //if all day or multi day, calculate day interval
                    $start_date = strtotime($start[0]); 
                    $end_date = strtotime($end[0]); 
                    $diff = ($end_date - $start_date)/60/60/24; 
                    $_POST['end'] = date('Y-m-d', strtotime($date . " + " . $diff . " day"));
                }
                // add date to array
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
                // save date info
                $data[] = $extra;
                $newJsonString = json_encode($data);
                file_put_contents('json/events.json', $newJsonString);
            }
        }
    // if single event
    } else {
        // if all day event, set the date only
        if($start[1] == '00:00:00') {
            $_POST['start'] = $start[0];
        }
        if($end[1] == '00:00:00') {
            $_POST['end'] = $end[0];
        }
        // add date to array
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
        // save date info
        $data[] = $extra;
        $newJsonString = json_encode($data);
        file_put_contents('json/events.json', $newJsonString);
    }
}
// back to fullCalendar
header('Location: '.$_SERVER['HTTP_REFERER']);	
?> 
