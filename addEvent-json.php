<?php 
  // error logging
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);
  
  require_once('sanitize.php');

  require 'class.Event.php';
  require 'class.Recurrence.php';
  require 'class.Week.php';

  // if event post
  if (isset($_POST['title'])) {

      // get dates data
      $jsonString = file_get_contents('json/events.json');
      $data = json_decode($jsonString, true);

      $id = end($data)['id'];
      $rid = end($data)['rid'];

      // if event is recurrence
      if ($_POST['recurrence']) {
          // increment to generate unique recurrence event id
          // creates association between events that are part of the same recurrence (event series)
          $rid = ++$rid;
          // loop over each week day
          foreach ($_POST['dayOfWeek'] as $key => $day) {
            $getDatesOfWeekDay = new Week($day, $_POST['start'], $_POST['endDate']);
            // gets all dates of that week day
            $datesOfWeekDay = $getDatesOfWeekDay->getWeekDatesInRange();
            foreach ($datesOfWeekDay as $date) {
              // increment to generate unique event id
              $id = ++$id;
              // add event for each date of that week day
              $addRecurrenceEvents[] = new Recurrence(
                $id, 
                $rid, 
                'repeating event', 
                sanitizeInput($_POST['title']), 
                sanitizeInput($_POST['description']), 
                $date, 
                $date, 
                sanitizeInput($_POST['color'])
              ); 
            }
          }
          // store dates
          $events = array_merge($data, $addRecurrenceEvents);
          $newJsonString = json_encode($events);
          file_put_contents('json/events.json', $newJsonString);

      // if single event
      } else {
        // increment by one to generate unique event identifiers
        $id = ++$id;
        $rid = ++$rid;
        $addSingleEvent = new Event(
          $id, 
          $rid, 
          'single event', 
          sanitizeInput($_POST['title']), 
          sanitizeInput($_POST['description']), 
          $_POST['start'], $_POST['end'], 
          sanitizeInput($_POST['color'])
        );
        // store dates
        $data[] = $addSingleEvent;
        $newJsonString = json_encode($data);
        file_put_contents('json/events.json', $newJsonString);
      }
  }
  // back to fullCalendar
  header('Location: '.$_SERVER['HTTP_REFERER']);
?>