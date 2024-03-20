<?php
require_once('../functions.php');
if (!$id) die();
$done=false;


			//BEHEN RESET NGA CDO ULJE
				$sql1="UPDATE produktet set cmimi=cmimiSALE,cmimiSale=0,ulje=0,uljeid=0 where uljeid={$id}";
				$conn->exec($sql1);
				$done=true;

   $conn->exec("DELETE FROM ulje where id={$id}"); 
   echo "1";
	