<?php

class Week {
  // week array holding key values and name mappings
  public static $dayOfWeekArray = array(
    array('M',1,'monday'),
    array('T',2,'tuesday'),
    array('W',3,'wednesday'),
    array('R',4,'thursday'),
    array('F',5,'friday'),
    array('S',6,'saturday'),
    array('U',7,'sunday'),
  );

  // initialize variables
  var $day;
  var $dateFrom;
  var $dateTo;
  var $dayOfWeekNumber;
  var $dayOfWeek;
  
  function __construct( $__day, $__dateFrom, $__dateTo ) {
    $this->convertDateFrom( $__dateFrom );
    $this->convertDateTo( $__dateTo );
    $this->getDayOfWeekNumber( $__day );
    $this->getDayOfWeek( $__day );
  }

  public function convertDateFrom( $__dateFrom ) {
    $this->dateFrom = new \DateTime(explode(" ", $__dateFrom)[0]);
  }

  public function convertDateTo( $__dateTo ) {
    $this->dateTo = new \DateTime($__dateTo);
  }

  public function getDayOfWeekNumber( $__day ) {
    $this->dayOfWeekNumber = self::$dayOfWeekArray[$__day][1];
  }

  public function getDayOfWeek( $__day ) {
    $this->dayOfWeek = self::$dayOfWeekArray[$__day][2];
  }

  // compute days in range
  public function getWeekDatesInRange() {
    $allDayRecurrences = [];

    // return empty if dateFrom > dateTo
    if ($this->dateFrom > $this->dateTo) {
      return $allDayRecurrences;
    }

    // get next closest day of week if != dateFrom
    if ($this->dayOfWeekNumber != $this->dateFrom->format('N')) {
      $this->dateFrom->modify('next '. $this->dayOfWeek);
    }

    // while dateFrom <= dateTo, get next week's date and store
    while ($this->dateFrom <= $this->dateTo) {
      $allDayRecurrences[] = $this->dateFrom->format('Y-m-d');
      $this->dateFrom->modify('+1 week');
    }
    return $allDayRecurrences;
  }
}

?>
