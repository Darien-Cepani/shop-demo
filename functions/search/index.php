<?php
require_once('../functions.php');

$cfare=strtolower(pastro($_REQUEST["term"]));



$query="SELECT concat('porosi.php?id=',id) as value,username as label from orders where lower(username) like '%{$cfare}%' or lower(tel) like '%{$cfare}%' or lower(email) like '%{$cfare}%'  or lower(qyteti) like '%{$cfare}%'  or lower(adresa) like '%{$cfare}%' group by username limit 0,10";

$arr=array();
foreach($GLOBALS['conn']->query($query ) as $row) { 
    array_push($arr,array('label'=>$row["label"],'value'=>$row["value"],'category'=>"Porosi"));
}










$arrkerko=explode(" ",$cfare);
$arrkerko[]=$cfare;

$arr=array();
$arrids=[];
foreach($arrkerko as $item) {
$cfare=$item;
$query="SELECT id,concat('produkte.php?id=',id) as value,concat(emri,' ',dimension1,' ',dimension2) as label from produktet where lower(emri) like '%{$cfare}%' or lower(dimension1) like '%{$cfare}%' or lower(pershkrimi) like '%{$cfare}%'  or lower(dimension2) like '%{$cfare}%' or lower(dimension3) like '%{$cfare}%' limit 0,10";

foreach($GLOBALS['conn']->query($query ) as $row) { 
    if (!in_array("Irix", $arrids)) {
    array_push($arr,array('label'=>$row["label"],'value'=>$row["value"],'category'=>"Produkte"));
    $arrids[]=$row["id"];
    }
}

    
}


/*
$query="SELECT concat('kliente.php?id=',id) as value,emri as label from kliente where (lower(kliente.emri) like '%{$cfare}%' or lower(kliente.tel) like '%{$cfare}%' or lower(kliente.email) like '%{$cfare}%'  or lower(nipt) like '%{$cfare}%'  or lower(nickname1) like '%{$cfare}%') {$shto} limit 0,10";



//array_push($arr,array('label'=>"Clients",'value'=>"#"));

foreach($GLOBALS['conn']->query($query ) as $row) { 
    array_push($arr,array('label'=>$row["label"],'value'=>$row["value"],'category'=>"Kliente"));
}
*/

print_r(json_encode($arr));


