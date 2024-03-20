<?php
require_once('../functions.php');

$sot=date('Y-m-d H:i');
$sot=str_replace(" ","T",$sot);


if ($id) {
$query="SELECT * FROM {$prindi} WHERE id = {$id}";
$row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
$status=megjejstatusid($row["statusi"],$prindi);


}

?>
<div class="row-fluid">
    <div class="col">
<div id="shtimkomenti" style="margin-bottom:20px;">        
<form id="komentet" name="komentet">     
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
<input type="hidden" name="prindi" id="prindi" value="<?php echo $prindi; ?>">

<div class="py-1 px-4"   >  
<select name="status" id="status"  class="form-control"   >
		<option value="">Statusi</option>
        <?php 
		foreach($conn->query("select * from statuse{$prindi} order by id asc") as $row2) { 
			$str="";
		?>
		<option value="<?php echo $row2["id"]?>"><?php echo $row2["status"]?></option>
        <?php } ?>
        </select>
</div> 



<div class="py-2 px-4 callback" style="display:none"  >  
<input type="datetime-local" disabled class="form-control" value="<?php echo $sot?>" id="callback" name="callback">
</div>



       
        
<div class="py-1 px-4" >  
<textarea name="komenti" id="komenti" cols="30" rows="3" style="width:100%" class="form-control" placeholder="Message"></textarea>
</div>

<div class="py-1 px-4" >  
<input value="SHTO" id="add" name="add" class="btn btn-danger " onClick="koment1(<?php echo $id; ?>,'<?php echo $prindi; ?>')" type="button">
</div>    
</form>
</div>


<script>
$("#status").on("change",function() {
    var tkst=$(this).find('option:selected').text();
    if ( tkst=="Call Back" ) {
        $(".callback").show();
        $("#callback").attr("disabled",false);
    }else {
         $(".callback").hide();
         $("#callback").attr("disabled",true);
    }
    
})
</script>

<script>
<?php if ($status) {?>
 $("#status").val('<?php echo $status; ?>').change();
<?php } ?>
</script>





<div id="komentetall">

<?php include "komentet.php" ?>


</div>
</div>

