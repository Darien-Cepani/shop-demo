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
  width:100%;
  height:100%;
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

<div class="plusi">+</div>
<form class="add-img-center" id="hidh" action="up.php" method="post" enctype="multipart/form-data">
  <input class="cursor-pointer" type="file" id="file" name="file[]" multiple="multiple" style="width:200px;height:200px;" onchange="beje();">
  <input type="submit">
</form>

</body>
</html>