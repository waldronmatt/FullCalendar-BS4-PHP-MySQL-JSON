<?php

class Event {        
    /* Member variables */
    var $id;
    var $eventType;
    var $title;
    var $description;
    var $start;
    var $end;
    var $color;
    
    function __construct( $__id, $__eventType, $__title, $__description, $__start, $__end, $__color )
    { 
        $this->id = $__id;
        $this->eventType = $__eventType;
        $this->title = $__title;
        $this->description = $__description;
        $this->setStart($__start);
        $this->setEnd($__end);
        $this->color = $__color;
    }

    public function setStart($__start) {
        $startTime = explode(" ", $_POST['start'])[1];
        $startDate = explode(" ", $_POST['start'])[0];

        if ($startTime === '00:00:00') {
            $this->start = $startDate;
        } else {
            $this->start = $__start;
        }
    }

    public function setEnd($__end) {
        $endTime = explode(" ", $_POST['end'])[1];
        $endDate = explode(" ", $_POST['end'])[0];
        
        if ($endTime === '00:00:00') {
            $this->end = $endDate;
        } else {
            $this->end = $__end;
        }
    }
}

?>