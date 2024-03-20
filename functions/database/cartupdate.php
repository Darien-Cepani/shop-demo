<?php
require_once("../functions.php");

$sasia=merrvar('sasia');
$size=merrvar('size');
$tot=merrvar('tot');



if ($size) {
    $query = "update shporta set size='{$size}',updated=1 where id={$id}";
    $conn->query($query);
}

if ($sasia>-1) {
        $query = "update shporta set sasia={$sasia},updated=1 where id={$id}";
    	$queryPorosi = "update orders set totali={$tot} where id in (SELECT owner from shporta where id={$id})";
    	$conn->query($query);
        $conn->query($queryPorosi);
}




