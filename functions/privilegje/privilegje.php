<?php
require_once('../functions.php');

$tabela="privilegje";
$select=[];

if ($id) {
    $str=",";
foreach($conn->query("SELECT * FROM privilegje where user={$id} order by id asc" ) as $row1) { 
    $str.=$row1["moduli"] . ",";
}
}




?>

<style>
.card {
    margin-bottom: 0px!important;
}
</style>

<form id="ndrysho" name="ndrysho">
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
<div class="container-fluid">
    
    
<div class="row">
    
<?php foreach($conn->query("SELECT * FROM modulet group by kategoria order by id asc" ) as $row2) { 
$kat=$row2["kategoria"];
?>
 
 <div class="card" style="width: 15rem;">
  <div class="card-body">
    <h5 class="card-title"><?php echo $kat?></h5>  
    <p class="card-text">
    
    <?php foreach($conn->query("SELECT * FROM modulet where kategoria like '{$kat}' order by id asc" ) as $row1) { 
        $ke=$row1["id"];
        if ($row1["tabela"]!="") {$ke=$row1["tabela"] . "-" . $row1["action"];}
    if (strpos($str,"," . $ke . ",")>-1) {
        $shto="checked";
    } else {
        $shto="";
    }
    ?>    
    
            <div class="col-md py-1">
                <input type="checkbox"  <?php echo $shto?> value="<?php echo $ke?>" name="modulet[]" id="modulet">
                <label class="form-check-label"><?php echo $row1["moduli"]?></label>

            </div>

    <?php } ?>
 
 </p>
  </div>
</div>
    <?php } ?>
    
    
</div>











</div>    
</form>
