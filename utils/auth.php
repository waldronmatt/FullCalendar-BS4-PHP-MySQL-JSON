<?php
  try {
    $auth = new PDO('mysql:host=localhost;dbname=calendar;charset=utf8', 'admin', 'password');
  }
  catch(Exception $error) {
    die('Error : ' . $error->getMessage());
  }
?>