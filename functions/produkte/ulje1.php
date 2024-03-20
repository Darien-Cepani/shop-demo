<?php
require_once('../functions.php');

$idt=merrvar("idt");
$ulja=merrvar("ulja");
$shenim=merrvar("shenim");	
$saprodukte=merrvar("saprodukte");
$shumaulur=merrvar("shumaulur");
$query=merrvar("query");


if ($ulja>0) {


				$sql1="UPDATE produktet set cmimi=cmimiSALE,cmimiSale=0,ulje=0,uljeid=0  where id in ({$idt}) and cmimiSALE>0 ";
				$conn->exec($sql1);


		$sql = "SELECT * FROM produktet where id in ({$idt})";
		foreach($conn->query($sql) as $row) { 
			$idreale.=$row["id"] . ",";
			$arr[$row["id"]]=array($row["cmimiSale"],$row["cmimi"]);
			$cmimiRI=$row["cmimi"] - ($ulja/100) * $row["cmimi"];
			$sql="UPDATE produktet set cmimiSale={$row["cmimi"]},ulje={$ulja},cmimi={$cmimiRI} where id={$row["id"]}";
			$conn->exec($sql);
			$shkrova=true;
		}
		
		$idreale=rtrim($idreale,",");

	if ($shkrova) {
		$gjendja=json_encode($arr);
		$conn->query("INSERT INTO ulje (shenim,idt,ulja,gjendja,shumaulur,saprodukte,query) VALUES ('{$shenim}','{$idreale}',$ulja,'{$gjendja}','{$shumaulur}','{$saprodukte}','{$query}')");
		$uljeid=$conn->lastInsertId();
		$sql="UPDATE produktet set uljeid={$uljeid} where id in ({$idreale})";
		$conn->exec($sql);
		echo "1";
	}

}

