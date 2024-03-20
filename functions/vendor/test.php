<?php
require(__DIR__ . '/autoload.php');

$phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
$geocoder = \libphonenumber\geocoding\PhoneNumberOfflineGeocoder::getInstance();



$connmaster = new PDO('mysql:host=localhost;dbname=crmx-master;charset=utf8mb4', 'crmxmaster', 'A27B00T3tYWVUyQh');
    foreach($connmaster->query('SELECT * FROM crm') as $rowmaster) {
        $db=$rowmaster["dbname"];
        $pbxip=$rowmaster["pbxip"];
        $name=$rowmaster["name"]; 
        $idmaster=$rowmaster["id"]; 
        $logomaster=$rowmaster["logo"];
        $mediaDir = 'media/' . $idmaster;
        $csvDir = 'media/acsv/' . $idmaster;
        
        $conn = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8mb4', 'crmxmaster', 'A27B00T3tYWVUyQh');

 echo $idmaster . " " . $name . "\n";



$sql="Select leads.id,leads.phone,leads.phonecheck,leads.country,countries.alpha_2 from leads inner join countries ON leads.country=countries.name where leads.phonecheck=0 order by leads.id desc limit 0,10";
//echo $sql;
foreach($GLOBALS["conn"]->query($sql) as $row) { 
$alfa=strtoupper($row["alpha_2"]);
$id=$row["id"];
//$GLOBALS["conn"]->query("UPDATE leads SET phonecheck=1 where id={$id}"); 
$phone=(int) filter_var($row["phone"], FILTER_SANITIZE_NUMBER_INT);
if ($phone>0) {
$Proto = $phoneUtil->parse($phone, $alfa);
$isValid = $phoneUtil->isValidNumber($Proto);
//echo $phone . " " . $alfa . " " . $isValid . "\n";
if ($isValid) {
    
    
   foreach($GLOBALS["conn"]->query("select * from countries where '{$phone}' like CONCAT(prefix,'%') order by prefix desc") as $row1) {
       echo $row1["name"] . "--->" . $phone . "\n";
   }
    
   $GLOBALS["conn"]->query("UPDATE leads SET valid_phone='yes' where id={$id}"); 
} 
}

}

}