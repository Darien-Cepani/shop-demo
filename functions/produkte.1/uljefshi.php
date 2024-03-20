<?php
require_once('../functions.php');
if (!$id) die();
$done=false;

		foreach($conn->query("SELECT * FROM ulje where id={$id}") as $row) { 
		    $gjendja=json_decode($row["gjendja"],true);
		    foreach($gjendja as $key => $item) {
		    	  $perq=0;
		    	  $diff=$item[0]-$item[1];
		    	  if ($diff>0) {
		        $perq=$diff/$item[0] * 100;
		    	  }
		        $sql="UPDATE produktet set cmimiSale={$item[0]},ulje={$perq},cmimi={$item[1]} where id={$key}";
		        $conn->exec($sql);
		        $done=true;
		    }
		}
if ($done) {
   $conn->exec("DELETE FROM ulje where id={$id}"); 
   echo "1";
}		