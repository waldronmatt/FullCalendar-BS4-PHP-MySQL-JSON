<?php
         ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
function getDatesInRange($dateFromString, $dateToString, $dow, $dowNum) {
    $dateFrom = new \DateTime($dateFromString);
    $dateTo = new \DateTime($dateToString);
    $dates = [];

    if ($dateFrom > $dateTo) {
        return $dates;
    }

    if ($dowNum != $dateFrom->format('N')) {
        $dateFrom->modify('next '. $dow);
    }

    while ($dateFrom <= $dateTo) {
        $dates[] = $dateFrom->format('Y-m-d');
        $dateFrom->modify('+1 week');
    }

    return $dates;
}

$dateFromString = '2019-1-01';
$dateToString = '2019-01-31';

$postDates = array(
    array('M',1,'monday'),
    array('T',2,'tuesday'),
    array('W',3,'wednesday'),
    array('R',4,'thursday'),
    array('F',5,'friday'),
    array('S',6,'saturday'),
    array('U',7,'sunday'),
);

$num = 0;
$post=array('1'=>'0','2'=>'2');
foreach ($post as $p) {
    $dowNum = $postDates[$p][1];
    $dow = $postDates[$p][2];
    $data = getDatesInRange($dateFromString, $dateToString, $dow, $dowNum);
    print_r(array_values($data));
    echo '<br>';
    echo 'Num of dates: ' . $count = count($data);
    echo '<br>';
    for ($x = 0; $x < $count; $x++) {
        echo 'Date: ' . $data[$x];
        echo '<br>';
    }
    echo 'Total date count: ' . $num += count($data);
    echo '<br>';
}


?>
