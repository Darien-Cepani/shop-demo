<?php
require_once('../functions.php');



$query="SELECT * FROM parametra order by id desc";
$row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
$video=$row["video"]?$row["video"]:'';
$videoRaw=$row["videoRaw"]?$row["videoRaw"]:'';

if ($video!="") {
$videolink="https://www.cdnimpuls.com/video/{$video}";
}
$plusi="+";
if ($videoRaw!="") {
  $plusi="...";
  $jam=checkExist("https://storage.googleapis.com/www.cdnimpuls.com/video/" . $videoRaw);
  
  if ($jam==200) {
    $conn->query("UPDATE parametra SET video='{$videoRaw}',videoRaw=''");
    $videolink="https://www.cdnimpuls.com/video/{$video}";
  }else{
    //$videolink="https://www.cdnimpuls.com/video/{$video}";
  }
}



?>

<!DOCTYPE html>
<html>
<link href="../../css/styles.css" rel="stylesheet" type="text/css">
<style>
html,body {
  width:100%;
  height:100%;
  margin:0;
  padding:0;
  background:#000;
}

.plusi {
  top:0;
  left:0;
  width:100%;
  height:100%;
  margin:0;
  padding:0;
    font-size: 7rem;
    position: absolute;
    color: lightgray;
    cursor: pointer;
    display:flex;
    justify-content:center;
    align-items:center;
}
</style>
<body>
  <script>
function beje() {
    document.forms.hidh.submit();
}
</script>

<?php if ($video) {?>
<div class="plusi">
<video loop autoplay muted playsinline width="100%" src="<?php echo $videolink?>" ></video>
</div>
<?php }else{ ?>
<div class="plusi"><?php echo $plusi?></div>
<?php }?>
<form style="opacity:0;" id="hidh" action="upvideo1.php" method="post" enctype="multipart/form-data">
  <input class="cursor-pointer" type="file" id="file" name="file[]" multiple="multiple" style="width:320px;height:188px;" onchange="beje();">
  <input type="submit">
</form>

</body>
</html>