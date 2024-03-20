<?php
require_once('../functions.php');


    $mesazhi = pastro($_REQUEST['komenti']);
    $statusi = pastro($_REQUEST['status']);
	$prindi = pastro($_REQUEST['prindi']);
	$callback = pastro($_REQUEST['callback']);


if ($id) {
$query="SELECT * FROM {$prindi} WHERE id = {$id}";
$row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);


bejkoment($id,$mesazhi,$statusi,$prindi,$callback);    
}





    
	


?>