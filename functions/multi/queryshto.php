<?php
require_once('../functions.php');


$kords=pastro($_REQUEST['kords']);
$ids=pastro($_REQUEST['ids']);
$emri=pastro($_REQUEST['emri']);
$foto=pastro($_REQUEST['foto']);

if (!$id) die("?");
    $arr=[];
	$query="SELECT * FROM multi WHERE id = {$id}";
	$row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
	if ($row["ids"]!="") {
		$arr=json_decode($row["ids"],true);
	}
	$arr[]=array($ids,$kords);
	$json=pastro(json_encode($arr));
	$sql="UPDATE multi set ids='{$json}' where id={$id}";
	$conn->query($sql);

