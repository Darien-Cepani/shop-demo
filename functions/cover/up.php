<?php
require('../functions.php');


if( isset($_FILES['cover']) and !$_FILES['cover']['error'] ){
  $emri=$_FILES['cover']['name']; 
  $ekst=ekst($emri);
  if ($ekst!="jpg") die();
  file_put_contents( "../../../media/cover/" . $emri, file_get_contents($_FILES['cover']['tmp_name']) );
  
  $query="UPDATE parametra SET cover='{$emri}'";
  $conn->query($query);
}

