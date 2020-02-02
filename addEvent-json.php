<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'class.Event.php';

// if post
if (isset($_POST['title'])) {

    // get date info
    $jsonString = file_get_contents('json/events.json');
    $data = json_decode($jsonString, true);

    $last_rid = end($data)['rid'];
    // split start, end into date, time
    $startDate = explode(" ", $_POST['start'])[0];
    $startTime = explode(" ", $_POST['start'])[1];
    $endDate = explode(" ", $_POST['end'])[0];
    $endTime = explode(" ", $_POST['end'])[1];

    // weekday array
    $dayOfWeekArray = array(
        array('M',1,'monday'),
        array('T',2,'tuesday'),
        array('W',3,'wednesday'),
        array('R',4,'thursday'),
        array('F',5,'friday'),
        array('S',6,'saturday'),
        array('U',7,'sunday'),
    );
    // compute days in range
    function getWeekDatesInRange($dateFrom, $dateTo, $dayOfWeek, $dayOfWeekNumber) {
        // array of dates
        $allDayRecurrences = [];
        // return empty if dateFrom > dateTo
        if ($dateFrom > $dateTo) {
            return $allDayRecurrences;
        }
        // get next closest dow if dowNUM != dateFrom
        if ($dayOfWeekNumber != $dateFrom->format('N')) {
            $dateFrom->modify('next '. $dayOfWeek);
        }
        // if dateFrom <= dateTo, modify by 1 week
        while ($dateFrom <= $dateTo) {
            $allDayRecurrences[] = $dateFrom->format('Y-m-d');
            $dateFrom->modify('+1 week');
        }
        return $allDayRecurrences;
    }

    function startFunc($dayRecurrence, $startTime) {
        $_POST['start'] =  $dayRecurrence . " " . $startTime;
                        // if all day event, set the date only
                        if ($startTime === '00:00:00') {
                            $_POST['start'] =  $dayRecurrence;
                        }
                        return $_POST['start'];
    }

    function endFunc($dayRecurrence, $startDate, $endTime, $endDate) {
                // set recurrence date, time for each date
                $_POST['end'] =  $dayRecurrence . " " .  $endTime;

                
                if ($endTime === '00:00:00') {
                //if all day or multi day, calculate day interval
                    $diff = (strtotime($endDate) - strtotime($startDate))/60/60/24; 
                    $_POST['end'] = date('Y-m-d', strtotime( $dayRecurrence . " + " . $diff . " day"));
                }
                return $_POST['end'];
    }

    // if event is recurrence
    if ($_POST['recurrence']) {
        // initialize vars
        $dateFromString = $startDate;
        $dateToString = $_POST['endDate'];
        // for each dow
        foreach ($_POST['dowID'] as $key => $value) {
            // initialize vars
            $dayOfWeekNumber = $dayOfWeekArray[$value][1];
            $dayOfWeek = $dayOfWeekArray[$value][2];
            $dateFrom = new \DateTime($dateFromString);
            $dateTo = new \DateTime($dateToString);

            // call days in range function
            $allDayRecurrences = getWeekDatesInRange($dateFrom, $dateTo, $dayOfWeek, $dayOfWeekNumber);
            // loop each day for dow
            foreach ($allDayRecurrences as $dayRecurrence) {
                $_POST['start'] =  startFunc($dayRecurrence, $startTime);
                $_POST['end'] =  endFunc($dayRecurrence, $startDate, $endTime, $endDate);

                // add date to array
                $addEvent = array(
                    'id' => ++ end($data)['id'],
                    'rid' => $last_rid + 1,
                    'eventType' => 'repeating event',
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'start' => $_POST['start'],
                    'end' =>  $_POST['end'],
                    'color' => $_POST['color'],
                );
                // save date info
                $data[] = $addEvent;
                $newJsonString = json_encode($data);
                file_put_contents('json/events.json', $newJsonString);
            }
        }
    // if single event
    } else {
        // Creating the object 
        $addSingleEvent = new Event(++ end($data)['id'], 'single event', $_POST['title'], $_POST['description'], $_POST['start'], $_POST['end'], $_POST['color']); 
        // Converting object to associative array
        $data[] = $addSingleEvent;
        $newJsonString = json_encode($data);
        file_put_contents('json/events.json', $newJsonString);
    }
}
// back to fullCalendar
header('Location: '.$_SERVER['HTTP_REFERER']);
?>