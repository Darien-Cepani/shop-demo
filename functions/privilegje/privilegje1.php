<?php
require_once('../functions.php');

$m=$_REQUEST["modulet"];

$modulet=$m;



$user=merrvar("id");

$sql="DELETE FROM privilegje where user={$user}";
$conn->exec($sql);

for ($i=0;$i<count($modulet);$i++) {
    $m1=pastro($modulet[$i]);
    $sql="INSERT INTO privilegje (user,moduli) VALUES ({$user},'{$m1}')";
    $conn->exec($sql);
}


foreach($conn->query("SELECT count(id) as sa FROM modulet" ) as $row2) {
    $gjithesej=$row2["sa"];
}

foreach($conn->query("SELECT * FROM roles" ) as $row2) {
    
    foreach($conn->query("SELECT count(id) as sa FROM privilegje where user='{$row2["id"]}'") as $rowpriv) { 
      $cope=$rowpriv["sa"]; 
     }
    
    $sql="UPDATE roles set Accesses='{$cope}/{$gjithesej}' where id={$row2["id"]}";
    $conn->exec($sql);
}