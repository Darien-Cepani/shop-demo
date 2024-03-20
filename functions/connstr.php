<?php 
session_start();
date_default_timezone_set('Europe/Tirane');


require_once("hosts.php");

$ip = $_SERVER['REMOTE_ADDR'];


//$myfile = fopen("/var/www/html/media/aksese.txt", "a") or die("Unable to open file!");
//fwrite($myfile, $ip . "," . $hosti . "\n");
//fclose($myfile);


$conn = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8mb4', 'shopmaster', 'o4GBvtKxL4vy0lqe');






/*datastudio access
datastudio
xOee4c0E26KbAwFo
*/