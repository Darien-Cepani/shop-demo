<?php
require_once('../functions.php');

$query="SELECT * FROM parametra order by id desc";
$row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
$favicon=$row["favicon"]?$row["favicon"]:'';

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

<?php if ($favicon) {?>
<div class="plusi">
<img width="150" src="../../../media/icon/<?php echo $favicon?>" />
</div>
<?php }else{ ?>
<div class="plusi">+</div>
<?php }?>
<form style="opacity:0;" id="hidh" action="upicon1.php" method="post" enctype="multipart/form-data">
  <input class="cursor-pointer" type="file" id="file" name="file[]" multiple="multiple" style="width:320px;height:188px;" onchange="beje();">
  <input type="submit">
</form>

</body>
</html>