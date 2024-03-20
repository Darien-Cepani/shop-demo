<?php
require_once('functions/functions.php');
include 'h.php';

//if (!k(29)) {die("Access Denied!");}	

	$koha = $_REQUEST['koha'];

$kyvit=date("Y", time() );
$sot=date("Y-m-d", time() );
if ($koha) {
	$kv=explode(" - ",$koha);
	$data1=$kv[0];
	$data2=$kv[1];
}else{

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


 <button onclick="shto()"  class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored shtim">
  <i class="material-icons">add</i>
</button>


<?php 

$kerko=" WHERE id<>-1 ";



foreach ($_REQUEST as $key => $value){
    if ($key == 'search') {break;} 
    if (!in_array($key,$kerkoJo)) {
    $kerko.=searchcope($key,$value);
    }
}





?>			  
    
<div class="row  py-3 kokeinfo">
<div class="col">     
<form method="get" >
<div class="row" style=""> 




<?php

$arr=array("Tag"=>"tag_s");

foreach($arr as $key=>$value) {
    echo fushaDiv("fushe-input-no-label",$key,$value,merrvar($value));
}
?>    
  
  

 <div class="col">
        <button type="submit" name="search" id="search" class="btn btn-primary">Kerko</button>  
    </div>
</div>
</form>
</div></div>



<div class="row px-4 py-4"> 

<div class="col">
<div class="table-responsive">    
<table id="tabela1" class="table table-striped table-bordered " width="100%">
<thead>
<tr>
                <th>Id</th>
                <th>tags</th>
                <th>Sizes</th>
                <th>Veprimi</th>
</tr>
</thead>
		<tbody>
		<?php
		$i=0;
		$sql = "SELECT * FROM sizes {$kerko} ORDER BY id DESC";
		foreach($conn->query($sql) as $row) { 
		//if ($row["active"]=="N") { $shto="style='background:#FFD3CE'";}else{$shto="";}
		?>
			<tr  <?php echo $shto;?>>
                <td ><?php echo $row['id'];?></td>
                <td><?php echo $row['tag'];?></td>
                <td><?php echo $row['sizes'];?></td>
				<td nowrap>


 <a href="javascript:ndrysho('<?php echo $row['id'];?>')" class="btn btn-warning btn-xs" ><i title="Edit" class="ikon icon-pencil"></i></a>

 <a href="javascript:fshi('<?php echo $row['id'];?>','sizes')" class="btn btn-danger btn-xs"><i title="Delete" class="ikon icon-close"></i></a>

					
				</td>
			</tr>
<?php } ?>
		</tbody>
	</table>
</div></div></div>



<script>


function merrumeselect(emri,value) {
    $("#" + emri).val(value).change();
} 



<?php foreach ($_REQUEST as $key => $value){ ?>
merrumeselect("<?php echo $key?>","<?php echo $value?>");
<?php } ?>


var tabela=$('#tabela').DataTable({
    dom: 'Bfrtip',
        buttons: [
             'excel','csv'
        ],
        "pageLength": 50,
        "order": [],
         
    
});
	




	function shto() {
		bejmodal("Shto","functions/sizes/edit.php",ndrysho1);
	}
	
	function ndrysho(id) {
		bejmodal("Ndrysho","functions/sizes/edit.php?id=" +id,ndrysho1);
	}
	


	function ndrysho1(){
		$.post( "functions/sizes/query.php", $( "#ndrysho" ).serialize(), function( data ) {
			location.reload();
		});
	}
	

</script>

<?php
include 'f.php';
?>