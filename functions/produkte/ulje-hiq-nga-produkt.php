<?php
require_once('../functions.php');


$idprodukti=merrvar("idprodukti");
$idulje=merrvar("idulje");

$sql1="UPDATE produktet set cmimi=cmimiSALE,cmimiSale=0,ulje=0,uljeid=0 where id={$idprodukti}";
$conn->exec($sql1);
echo "1";

