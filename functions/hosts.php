<?php
date_default_timezone_set('Europe/Tirane');
$hosti=$argv[1];

if (!$hosti) {
$hosti=$_SERVER['HTTP_HOST'];
}

$connmaster = new PDO('mysql:host=localhost;dbname=shop-master;charset=utf8mb4', 'shopmaster', 'o4GBvtKxL4vy0lqe');
    foreach($connmaster->query('SELECT * FROM shops') as $rowmaster) {
       if ($hosti==$rowmaster["host"]) {
        $db=$rowmaster["dbname"];
        $name=$rowmaster["name"]; 
        $idmaster=$rowmaster["id"]; 
       } 
    }

if ($hosti=="" || $db=="") {
die("mediadesk.com");
}




