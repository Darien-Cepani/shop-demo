<?php
require_once('../functions.php');

//if (!k(15)) {die("Access Denied!");}

if ($id) {
$query="SELECT * FROM dimensione WHERE id = {$id}";
$row33 = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
}


?>
<style>
label {
    opacity:0.4;
    font-size:0.8em;
}
</style>

    <form id="ndrysho" name="ndrysho">
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
    <input type="hidden" name="lloji" id="lloji" value="<?php echo $row33["lloji"]; ?>">


    <div class="col py-2">
    <label >emri</label>    
         <input type="text" id="emri" name="emri" class="form-control" value="<?php echo $row33["emri"]?>">  
    </div>

    </div>
    </form>
<script>
$("#lloji").val($("#dimensioni").val());
</script>