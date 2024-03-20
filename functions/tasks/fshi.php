<?php
require_once('../functions.php');
if (!$id) {die();}
$conn->exec("DELETE from taskslist where id={$id}");
