<?php
require_once('../functions.php');
if (!k(54)) {
    die("Access denied!");
}
$query="DELETE FROM mesazhe WHERE id = {$id}";
$conn->query($query);