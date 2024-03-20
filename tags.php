<?php
require_once('functions/functions.php');
include 'h.php';

$sql = "SELECT tags FROM produktet where tags<>''";
foreach($conn->query($sql) as $row) { 
	$arrngj=explode(",",$row["tags"]);
	foreach ($arrngj as $ngj) {
	$arr[$ngj]++;
	}
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
<h4>Tags</h4>
</div></div>


<div class="container">
<div class="row px-4 py-4"> 

<div class="col">
<div class="table-responsive">    
<table id="tabela1" class="table table-striped table-bordered " width="100%">
<thead>
<tr>
                <th>Id</th>
                <th>Tag</th>
                <th>Veprimi</th>
</tr>
</thead>
		<tbody id="sortable">
		<?php
		$i=0;
		$sql = "SELECT * FROM tags ORDER BY radha asc";
		foreach($conn->query($sql) as $row) { 
		?>
			<tr id="m_<?php echo $row['id']?>"  <?php echo $shto;?>>
                   <td class="handle" ><span class="material-icons" style="color:#ccc;font-size:14px;">format_line_spacing</span>  <?php echo ++$i;?></td>

                <td><?php echo $row['tag'];?> (<?php echo $arr[$row['tag']];?>)</td>

				<td nowrap>


 <a href="javascript:ndrysho('<?php echo $row['id'];?>')" class="btn btn-warning btn-xs" ><i title="Edit" class="ikon icon-pencil"></i></a>

 <a href="javascript:fshi('<?php echo $row['id'];?>','tags')" class="btn btn-danger btn-xs"><i title="Delete" class="ikon icon-close"></i></a>

					
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
		$.post("functions/database/rendit.php?t=tags&"+order,  function( data ) {
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
		bejmodal("Shto tag","functions/tags/edit.php",ndrysho1);
	}
	
	function ndrysho(id) {
		bejmodal("Ndrysho tag","functions/tags/edit.php?id=" +id,ndrysho1);
	}
	


	function ndrysho1(){
		$.post( "functions/tags/query.php", $( "#ndrysho" ).serialize(), function( data ) {
			location.reload();
		});
	}
	


</script>

<?php
include 'f.php';
?>