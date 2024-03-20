<?php
require_once('functions/functions.php');
include 'h.php';

$sql = "SELECT count(id) as sa,kategoria FROM produktet group by kategoria";
foreach($conn->query($sql) as $row) { 
	$arr[$row["kategoria"]]=$row["sa"];
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

$kerkoJo=array("cmimi_s","koha1_s");

foreach ($_REQUEST as $key => $value){
    if ($key == 'search') {break;} 
    if (!in_array($key,$kerkoJo)) {
    $kerko.=searchcope($key,$value);
    }
}

$koha=$_REQUEST["koha1_s"];

if ($koha!="") {
	$arr=explode(" - ",$koha);
	$kerko.=" AND data between '{$arr[0]}' and '{$arr[1]}' ";
}







if ($id) {
	$kerko.=" and id={$id} ";
}



?>			  
    
<div class="row  py-3 kokeinfo">
<div class="col px-4">     
<h4>Kategori</h4>
</div></div>


<div class="container">
<div class="row px-4 py-4"> 

<div class="col">
<div class="table-responsive">    
<table id="tabela1" class="table table-striped table-bordered " width="100%">
<thead>
<tr>
                <th>Id</th>
                <th>Kategori</th>
                <th>Veprimi</th>
</tr>
</thead>
		<tbody id="sortable">
		<?php
		$i=0;
		$sql = "SELECT * FROM kategori ORDER BY radha asc";
		foreach($conn->query($sql) as $row) { 
		?>
			<tr id="m_<?php echo $row['id']?>"  <?php echo $shto;?>>
                <td class="handle" ><span class="material-icons" style="color:#ccc;font-size:14px;">format_line_spacing</span>  <?php echo ++$i;?></td>

                <td><?php echo $row['kategori'];?> (<?php echo $arr[$row['kategori']];?>)</td>

				<td nowrap>

 <a href="javascript:ndrysho('<?php echo $row['id'];?>')" class="btn btn-warning btn-xs" ><i title="Edit" class="ikon icon-pencil"></i></a>

 <a href="javascript:fshi('<?php echo $row['id'];?>','kategori')" class="btn btn-danger btn-xs"><i title="Delete" class="ikon icon-close"></i></a>

					
				</td>
			</tr>
<?php } ?>
		</tbody>
	</table>
</div></div></div>
</div>


<script>


    $("#sortable").sortable({
      handle : '.handle',
      update : function () {
		var order = $('#sortable').sortable('serialize');
		$.post("functions/database/rendit.php?t=kategori&"+order,  function( data ) {
			console.log(data);
		});

       }
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
	




	function shto() {
		bejmodal("Shto kategori","functions/kategori/edit.php",ndrysho1);
	}
	
	function ndrysho(id) {
		bejmodal("Ndrysho kategori","functions/kategori/edit.php?id=" +id,ndrysho1);
	}
	


	function ndrysho1(){
		$.post( "functions/kategori/query.php", $( "#ndrysho" ).serialize(), function( data ) {
			location.reload();
		});
	}
	


</script>

<?php
include 'f.php';
?>