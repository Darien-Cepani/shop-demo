<?php
require(__DIR__ . '/autoload.php');

$phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
$geocoder = \libphonenumber\geocoding\PhoneNumberOfflineGeocoder::getInstance();



$connmaster = new PDO('mysql:host=localhost;dbname=crmx-master;charset=utf8mb4', 'crmxmaster', 'A27B00T3tYWVUyQh');
    foreach($connmaster->query('SELECT * FROM crm where id=5') as $rowmaster) {
        $db=$rowmaster["dbname"];
        $pbxip=$rowmaster["pbxip"];
        $name=$rowmaster["name"]; 
        $idmaster=$rowmaster["id"]; 
        $logomaster=$rowmaster["logo"];
        $mediaDir = 'media/' . $idmaster;
        $csvDir = 'media/acsv/' . $idmaster;
        
        $conn = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8mb4', 'crmxmaster', 'A27B00T3tYWVUyQh');

 echo $idmaster . " " . $name . "\n";




$sql="Select  * from countries";
//echo $sql;
foreach($GLOBALS["conn"]->query($sql) as $row) { 
$id=$row["id"];

$prefix=$phoneUtil->getCountryCodeForRegion(strtoupper($row["alpha_2"]));
echo $prefix . "\n";

$GLOBALS["conn"]->query("UPDATE countries SET prefix='{$prefix}' where id={$id}"); 

}

}