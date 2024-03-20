<?php
require_once("../functions.php");

$ngjyra=merrvar('ngjyra');

$query = "update shporta set ngjyra='{$ngjyra}',updated=1 where id={$id}";

$conn->query($query);
