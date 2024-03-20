<?php
require_once('../functions.php');


$kords=pastro($_REQUEST['kords']);
$ids=pastro($_REQUEST['ids']);

if (!$id) die("?");
    $arr=[];
    
    $ids1=explode(",",$ids);
    $kords1=explode("~",$kords);
    
    for($i=0;$i<count($ids1);$i++) {
	$arr[]=array($ids1[$i],$kords1[$i]);
    }
	
	
	$json=pastro(json_encode($arr));
	$sql="UPDATE multi set ids='{$json}' where id={$id}";
	$conn->query($sql);

