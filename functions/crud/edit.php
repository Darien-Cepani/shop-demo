<?php
require_once('../functions.php');

$tabela=pastro($_REQUEST["t"]);
$select=[];

if ($id) {
$query="SELECT * FROM {$tabela} WHERE id = {$id}";
$row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
}

?>


<form id="ndrysho" name="ndrysho">
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
<input type="hidden" name="t" id="t" value="<?php echo $tabela; ?>">

    <?php foreach ($kolonat as $kolona) { ?>    
            <div class="col py-2">
	            <label><?php echo ucfirst($kolona[0])?></label>
	            
	            <?php if ($kolona[2]=="text") {?>
	            
	            <textarea  class="form-control"  name="<?php echo $kolona[0]?>" id="<?php echo $kolona[0]?>"><?php echo $row[$kolona[0]];?></textarea>
	            
	            <?php }else{ ?>
	            
	            <?php if ($kolona[1]=="") {?>
                <input type="text" class="form-control" value="<?php echo $row[$kolona[0]];?>" name="<?php echo $kolona[0]?>" id="<?php echo $kolona[0]?>">
                <?php }else{ 
                    $arr=[$kolona[0],$row[$kolona[0]]];
                    array_push($select,$arr);
                ?>
                <select class="select form-control" name="<?php echo $kolona[0]?>" id="<?php echo $kolona[0]?>"  style="width:100%">
                    <?php echo plotesoselect($kolona[1],true);?>
                </select>
                <?php }} ?>
            
            </div>

    <?php } ?>
    
</form>
<link href="js/select2/select2.min.css" rel="stylesheet" />
<script src="js/select2/select2.min.js"></script>

<script>
//$(document).ready(function() {
//    $('.select').select2({
//  tags: true
//});

function merrumeselect(emri,value) {
    $("#" + emri).val(value).change();
} 

<?php foreach ($select as $kush) {?>
merrumeselect("<?php echo $kush[0]?>","<?php echo $kush[1]?>");
<?php } ?>


</script>