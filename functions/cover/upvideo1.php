<?php
require('../functions.php');
$allowedExts = array("mp4", "jpeg", "gif", "png");

for($i=0; $i<count($_FILES['file']['name']); $i++) {
    $extension = strtolower(ekst($_FILES["file"]["name"][$i]));
    echo $_FILES["file"]["name"][$i];
        if (in_array($extension, $allowedExts))  {
            $tmpFilePath = $_FILES['file']['tmp_name'][$i];
            $newFilePath = uniqid() . "." . $extension;
            move_uploaded_file($tmpFilePath,"../../../media/cover/" . $newFilePath);
            
              $query="UPDATE parametra SET video='',videoRaw='{$newFilePath}'";
              $conn->query($query);
         
        }
}

$str=get_headers("http://video.blue.al/video.php?url=https://{$shopHost}/media/cover/" . $newFilePath);
header('Location: upvideo.php');
?>
