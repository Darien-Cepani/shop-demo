<!DOCTYPE html>
<html>
<link href="../../css/styles.css" rel="stylesheet" type="text/css">
<body>


<form style="width:150px;height:150px;" class="add-img-center" id="hidh" action="up.php" method="post" enctype="multipart/form-data" >
  <input style="width:150px;height:150px;" type="file" id="file" name="file" multiple="multiple" onchange="beje();">
</form>

  <script>
function beje() {
    document.forms.hidh.submit();
}
</script>

</body>
</html>