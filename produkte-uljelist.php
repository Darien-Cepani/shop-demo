<?php
require_once('functions/functions.php');
include 'h.php';

$idulje=merrvar("uljeid_s");

$sql = "SELECT * FROM ulje where id={$idulje}";
foreach($conn->query($sql) as $row) { 
	$emriulje=$row["shenim"];
}

?>
<link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
<script type="text/javascript" src="js/DataTables/datatables.min.js"></script>
<style>
.dt-buttons {
    float:right;
    margin-left:20px;
}
.table td {
	line-height:1em;
	font-size:0.9em;
}
</style>



  
    
<?php 
$kamfilter=false;
$kerko=" WHERE id<>-1 ";



foreach ($_REQUEST as $key => $value){
    if ($key == 'search') {break;} 
    if (!in_array($key,$kerkoJo)) {
    $kerko.=searchcope($key,$value);
    }
}






?>			  
    

<h4 class="px-4 py-4">Ulja: <?php echo $emriulje?></h4>

<div class="row px-4 py-4" style="margin-bottom:80px;"> 

<div class="col">
<div class="table-responsive">    
<table id="tabela" class="table table-striped table-bordered " width="100%">
<thead>
<tr>
<th></th>
<th>Kodi</th>
<th>Foto</th>
<th>Emri</th>
<th>Marka</th> 
<th>Tags</th>        
<th>Gjinia</th>       
<th>Pershkrimi</th>
<th align="right">Cmimi Pa Ulje</th>
<th align="right">Ulje %</th>
<th align="right">Çmimi Aktual</th>
<th>Veprimi</th> 
</tr>
</thead>
		<tbody>
		<?php
		$i=0;
		$ids=array();
		$total=0;
		$sql = "SELECT * FROM produktet {$kerko} ORDER BY id DESC";
		//echo $sql;
		foreach($conn->query($sql) as $row) { 
		$ids[]=$row["id"];   
		$total+=$row["cmimi"];
		$fototArr = explode(",",$row['fotot']);
		$shto="";
		if ($row["shfaq"]=="0") { $shto="style='background:#FFD3CE'";}
		if ($row["shfaq"]>0 && $row["shfaq"]<10 ) { $shto="style='background:#e0f2f1'";}
		?>
			<tr  <?php echo $shto;?>>
	            <td align="center"><input type="checkbox" data-id="<?php echo $row["id"]; ?>" class="checks" checked></td>
				<td><?php echo $row["kodi"]; ?></td>
				<td><img data-src="<?php echo $imazheUrl; ?>media/-100-100-<?php echo $fototArr[0];?>" src="../images/paimg.jpg" class="prod-img-cart lazyload"></td>
				<td><?php echo $row['emri']?></td>
                <td><?php echo $row['marka']?></td>
				<td><?php echo $row['tags']; ?></td>
				<td><?php echo $row['kategoria']; ?></td>
				<td><?php echo $row['pershkrimi']; ?></td>
                <td align="right"><?php echo $row['cmimiSale']; ?></td>
				<td align="right"><?php echo $row['ulje']; ?></td>
				<td align="right"><?php echo $row['cmimi']; ?></td>
				<td nowrap>
<a target="_blank" href="/produkti.php?id=<?php echo $row['id']?>" class="btn btn-info btn-xs" ><i title="Shiko" class="ikon icon-eye"></i></a>


					
				</td>
			</tr>
<?php } ?>
		</tbody>
	</table>
</div></div></div>

<?php if (!empty($ids) && $kamfilter) {?>
<input type="hidden" id="ids" value="<?php echo join(",",$ids);?>" >
<input type="hidden" id="total" value="<?php echo $total;?>" >
<input type="hidden" id="query_s" value="<?php 
foreach ($_REQUEST as $key => $value){
    if (is_array($value)) $value=join(",",$value);
    if ($value) {
        echo str_replace("_s","",$key) . " - " . $value . "; ";
    }
}

?>" >


<script>
$("#uljediv").show();
</script>
<?php } ?>



<script>

  	$(document).ready(function() {
      $('#tags_s').select2({'placeholder': "Tags"});
      $('#marka_s').select2({'placeholder': "Marka"});
      $('#kategoria_s').select2({'placeholder': "Kategoria"});
        });
    

function merrumeselect(emri,value) {
    $("#" + emri).val(value).change();
} 




var tabela=$('#tabela').DataTable({
    dom: 'Bfrtip',
        buttons: [
             'excel','csv'
        ],
        "pageLength": 50,
        "order": [],
         
    
});
	


	



$(".checks").on("click",function() {
 
 var idprodukti=$(this).data("id");
 var idulje=<?php echo $idulje?>;
    
   		$.post( "functions/produkte/ulje-hiq-nga-produkt.php", {idprodukti:idprodukti,idulje:idulje}, function( data ) {
		    console.log(data);
		    //if (data==1) {alert("Sukses"); }else{alert("Gabim");}
			location.reload();
		});
    
    
})


</script>
<script src="/js/lazysizes.min.js" async=""></script> 

<?php
include 'f.php';
?>