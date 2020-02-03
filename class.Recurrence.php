<?php

require_once 'class.Event.php';

class Recurrence extends Event {
    
    function __construct( $__id, $__rid, $__eventType, $__title, $__description, $__start, $__end, $__color )
    {
        parent::__construct($__id, $__rid, $__eventType, $__title, $__description, $__start, $__end, $__color);
    }

    // method overriding for calculating
    public function setStartDateTime($__start) {
        $startTime = explode(" ", $_POST['start'])[1];

        if ($startTime === '00:00:00') {
            // set to date if 'all day, many day' event
            $this->start =  $__start;
        } else {
            $this->start =  $__start . " " . $startTime;
        }
    }

    public function setEndDateTime($__end, $__start) {
        $startDate = explode(" ", $_POST['start'])[0];
        $endDate = explode(" ", $_POST['end'])[0];
        $endTime = explode(" ", $_POST['end'])[1];

        if ($endTime === '00:00:00') {
            // set to date if 'all day, many day' event
            $diff = (strtotime($endDate) - strtotime($startDate))/60/60/24;
            // calculate diff between start/end
            // diff used for all dates
            $this->end = date('Y-m-d', strtotime( $__end . " + " . $diff . " day"));
        } else {
            $this->end =  $__end . " " .  $endTime;
        }
    }
}

?>