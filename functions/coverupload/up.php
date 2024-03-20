<?php
require('../functions.php');
echo "Uploading.....";


$allowedExts = array("jpg", "jpeg", "gif", "png");


    $extension = strtolower(ekst($_FILES["file"]["name"]));
        if (in_array($extension, $allowedExts))  {
            $tmpFilePath = $_FILES['file']['tmp_name'];
            $newFilePath = slug(str_replace("." . $extension,"",$_FILES['file']['name'][$i])) . "-" . uniqid() . "." . $extension;
            move_uploaded_file($tmpFilePath,"../../../media/" . $newFilePath);
            
            $headers=get_headers("<?php echo $imazheUrl; ?>media/" . $newFilePath);
            
            ?>
            <script>
            parent.document.getElementById("cover").value="<?php echo $newFilePath?>";
            </script>
            
            <?php
        }

?>
<script>
parent.shfaqcover();
window.location="upload.php";
</script>