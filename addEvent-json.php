<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'class.Event.php';
require 'class.Recurrence.php';

// if post
if (isset($_POST['title'])) {

    // get date info
    $jsonString = file_get_contents('json/events.json');
    $data = json_decode($jsonString, true);

    $id = end($data)['id'];
    $rid = end($data)['rid'];

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

    // if event is recurrence
    if ($_POST['recurrence']) {
        $rid = ++$rid;
        // for each dow
        foreach ($_POST['dowID'] as $key => $value) {
            // initialize vars
            $dayOfWeekNumber = $dayOfWeekArray[$value][1];
            $dayOfWeek = $dayOfWeekArray[$value][2];
            $dateFrom = new \DateTime(explode(" ", $_POST['start'])[0]);
            $dateTo = new \DateTime($_POST['endDate']);

            // call days in range function
            $allDayRecurrences = getWeekDatesInRange($dateFrom, $dateTo, $dayOfWeek, $dayOfWeekNumber);
            // loop each day for dow
            foreach ($allDayRecurrences as $dayRecurrence) {
                $id = ++$id;
                // Creating the object 
                $storeRecurrenceEvents[] = new Recurrence($id, $rid, 'repeating event', $_POST['title'], $_POST['description'], $dayRecurrence, $dayRecurrence, $_POST['color']); 
            }
        }

        // Convert object to associative array
        $newData = array_merge($data, $storeRecurrenceEvents);
        $newJsonString = json_encode($newData);
        file_put_contents('json/events.json', $newJsonString);

    // if single event
    } else {
        $id = ++$id;
        $rid = ++$rid;
        // Create the object 
        $addSingleEvent = new Event($id, $rid, 'single event', $_POST['title'], $_POST['description'], $_POST['start'], $_POST['end'], $_POST['color']);
 
        // Convert object to associative array
        $data[] = $addSingleEvent;
        $newJsonString = json_encode($data);
        file_put_contents('json/events.json', $newJsonString);
    }
}
// back to fullCalendar
header('Location: '.$_SERVER['HTTP_REFERER']);
?>