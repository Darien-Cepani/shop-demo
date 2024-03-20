<?php
require('../functions.php');
echo "Uploading.....";

$allowedExts = array("jpg", "jpeg", "gif", "png", "webp");

for($i=0; $i<count($_FILES['file']['name']); $i++) {
    
    
    $extension = strtolower(ekst($_FILES["file"]["name"][$i]));
        if (in_array($extension, $allowedExts))  {
            $tmpFilePath = $_FILES['file']['tmp_name'][$i];

            $newFilePath = slug(str_replace("." . $extension,"",$_FILES['file']['name'][$i])) . "-" . uniqid() . "." . $extension;
            move_uploaded_file($tmpFilePath,"../../../media/" . $newFilePath);
            
            
            if ($extension=="webp"){
                echo "1";
                $im = imagecreatefromwebp("../../../media/" . $newFilePath);
                echo "2";
                $newFilePath.=".jpg";
                imagejpeg($im, "../../../media/" . $newFilePath, 100);
                imagedestroy($im);
            }
            
            
            $headers=get_headers("<?php echo $imazheUrl; ?>media/" . $newFilePath);
            
            ?>
            <script>
            parent.document.getElementById("fotot").value+="<?php echo $newFilePath?>" + ",";
            </script>
            
            <?php
        }
}
?>
<script>
parent.shfaqfotot();
window.location="upload.php";
</script>