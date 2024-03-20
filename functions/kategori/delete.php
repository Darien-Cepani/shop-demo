<?php
require_once('../conn.php');
require_once('../functions.php');

//if (!k(16)) {die("Access Denied!");}

$query="DELETE FROM kategori WHERE id = {$id}";
$conn->query($query);
