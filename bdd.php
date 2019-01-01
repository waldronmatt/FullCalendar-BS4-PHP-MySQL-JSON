<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=calendar;charset=utf8', 'root', 'your_password');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
