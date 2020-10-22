<?php

class Event {        
  // initialize variables
  var $id; // unique event id
  var $rid; // unique recurrence id
  var $eventType;
  var $title;
  var $description;
  var $start;
  var $end;
  var $color;
  
  function __construct( $__id, $__rid, $__eventType, $__title, $__description, $__start, $__end, $__color ) { 
    $this->id = $__id;
    $this->rid = $__rid;
    $this->eventType = $__eventType;
    $this->title = $__title;
    $this->description = $__description;
    $this->setStartDateTime( $__start );
    $this->setEndDateTime( $__end, $__start );
    $this->color = $__color;
  }

  public function setStartDateTime( $__start ) {
    $startTime = explode(" ", $__start)[1];
    $startDate = explode(" ", $__start)[0];

    // set to date if 'all day, many day' event
    if ($startTime === '00:00:00') {
      $this->start = $startDate;
    } else {
      $this->start = $__start;
    }
  }

  public function setEndDateTime( $__end, $__start ) {

    // $__start is null here (only used on recurrence method for overriding)
    $endTime = explode(" ", $__end)[1];
    $endDate = explode(" ", $__end)[0];
    
    // set to date if 'all day, many day' event
    if ($endTime === '00:00:00') {
      $this->end = $endDate;
    } else {
      $this->end = $__end;
    }
  }
}

?>
