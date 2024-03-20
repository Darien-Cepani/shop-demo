<?php
require_once('../functions.php');

$idt=merrvar("idt");
$ulja=merrvar("ulja");
$shenim=merrvar("shenim");	
$saprodukte=merrvar("saprodukte");
$shumaulur=merrvar("shumaulur");
$query=merrvar("query");

if ($ulja>0) {

		$sql = "SELECT * FROM produktet where id in ({$idt})";
		foreach($conn->query($sql) as $row) { 
			$arr[$row["id"]]=array($row["cmimiSale"],$row["cmimi"]);
			
			$cmimiRI=$row["cmimi"] - ($ulja/100) * $row["cmimi"];
			
			$sql="UPDATE produktet set cmimiSale={$row["cmimi"]},ulje={$ulja},cmimi={$cmimiRI} where id={$row["id"]}";
			$conn->exec($sql);
			
			$shkrova=true;
			
		}

if ($shkrova) {
$gjendja=json_encode($arr);
$conn->query("INSERT INTO ulje (shenim,idt,ulja,gjendja,shumaulur,saprodukte,query) VALUES ('{$shenim}','{$idt}',$ulja,'{$gjendja}','{$shumaulur}','{$saprodukte}','{$query}')");

echo "1";
}

}

