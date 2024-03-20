<?php 
require_once('../functions.php');
$kolona=merrvar("k");
$vlera=merrvar("v");
$tabela=merrvar("t");
$id=merrvar("id");

if ($tabela=="operatore") {die();}

if ($tabela=="leads") {
 $prefix="LEA";
 $fusha="lead_no";
}
if ($tabela=="clients") {
 $prefix="ACC";
 $fusha="acc_no";
}
if ($tabela=="ft") {
 $prefix="MTT";
 $fusha="crm_id";
}


if ($id) {
$sql="UPDATE {$tabela} SET {$kolona}='{$vlera}' WHERE id={$id}";
$conn->exec($sql);
}else{
$sql="INSERT INTO {$tabela}({$kolona},created_by) VALUES ('{$vlera}','{$_SESSION["username"]}')";
$conn->exec($sql);
$id=$conn->lastInsertId();
echo $id;
histori($id,"Insert","Manual",$tabela);
$bukurid=$prefix . str_pad($id,8,'0',STR_PAD_LEFT);
$sql="UPDATE {$tabela} SET {$fusha}='{$bukurid}' where id={$id}";
$conn->exec($sql);
}

if ($tabela=="ft" && $kolona=="client") {

 
 //KUSH E KA PASUR KETE KLIENT KUR ESHTE BERE TrANS I FUNDIT
 $query="SELECT assigned_to FROM ft where client={$vlera} order by id desc limit 0,1";
 $row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
 $assigned_to=$row["assigned_to"];
 if ($assigned_to!="") {
 $sql="UPDATE ft SET original_transaction_owner='{$assigned_to}' where id={$id}";
 $conn->exec($sql);
 }
 
  //KUSH E KA KETE KLIENT
 $query="SELECT assigned_to FROM clients where id={$vlera}";
 $row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
 $assigned_to=$row["assigned_to"];
 $sql="UPDATE ft SET assigned_to='{$assigned_to}' where id={$id}";
 $conn->exec($sql);

 
}