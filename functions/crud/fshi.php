<?php
require_once('../functions.php');
$tabela=pastro($_REQUEST["t"]);
$query="DELETE FROM {$tabela} WHERE id = {$id}";
if (k($tabela ."-delete")) {
$conn->query($query);
}
