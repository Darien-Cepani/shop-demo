<?php
require('../functions.php');
$allowedExts = array("svg", "jpeg", "gif", "png", "jpg");

for($i=0; $i<count($_FILES['file']['name']); $i++) {
    $extension = strtolower(ekst($_FILES["file"]["name"][$i]));
    echo $_FILES["file"]["name"][$i];
        if (in_array($extension, $allowedExts))  {
            $tmpFilePath = $_FILES['file']['tmp_name'][$i];
            $newFilePath = uniqid() . "." . $extension;
            move_uploaded_file($tmpFilePath,"../../../media/logo/" . $newFilePath);
            
              $query="UPDATE parametra SET logo='{$newFilePath}'";
              $conn->query($query);
         
        }
}
header('Location: uplogo.php');
?>
