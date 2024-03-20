<?php
require_once('functions/functions.php');
include 'h.php';

$dimension=merrvar("d");
if(!is_numeric($dimension)) die();
$dimension="dimension" . $dimension;

$sql = "SELECT count(id) as sa,{$dimension} FROM produktet group by {$dimension}";
foreach($conn->query($sql) as $row) { 
	$arr[$row[$dimension]]=$row["sa"];
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

<input type="hidden" name="dimensioni" id="dimensioni" value="<?php echo $dimension?>"> 
 
<div class="row  py-3 kokeinfo">
<div class="col px-4">     
<h4><?php echo strtoupper($dimensionetArr[$dimension])?></h4>
</div></div>


<div class="container">
<div class="row px-4 py-4"> 

<div class="col">
<div class="table-responsive">    
<table id="tabela1" class="table table-striped table-bordered " width="100%">
<thead>
<tr>
                <th>Id</th>
                <th><?php echo strtoupper($dimensionetArr[$dimension])?></th>
                <th>Veprimi</th>
</tr>
</thead>
		<tbody id="sortable">
		<?php
		$i=0;
		$sql = "SELECT * FROM dimensione where lloji like '{$dimension}' ORDER BY radha asc";
		foreach($conn->query($sql) as $row) { 
			$sa=$arr[$row["emri"]]?$arr[$row["emri"]]:"0";
		?>
			<tr id="m_<?php echo $row['id']?>"  <?php echo $shto;?>>
                   <td class="handle" ><span class="material-icons" style="color:#ccc;font-size:14px;">format_line_spacing</span>  <?php echo ++$i;?></td>

                <td><?php echo $row['emri'];?> (<?php echo $sa;?>)</td>

				<td nowrap>


 <a href="javascript:ndrysho('<?php echo $row['id'];?>')" class="btn btn-warning btn-xs" ><i title="Edit" class="ikon icon-pencil"></i></a>

 <a href="javascript:fshi('<?php echo $row['id'];?>','dimensione')" class="btn btn-danger btn-xs"><i title="Delete" class="ikon icon-close"></i></a>
					
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
		$.post("functions/database/rendit.php?t=dimensione&"+order,  function( data ) {
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
		bejmodal("Shto <?php echo strtoupper($dimensionetArr[$dimension])?>","functions/dimensione/edit.php",ndrysho1);
	}
	
	function ndrysho(id) {
		bejmodal("Ndrysho <?php echo strtoupper($dimensionetArr[$dimension])?>","functions/dimensione/edit.php?id=" +id,ndrysho1);
	}
	


	function ndrysho1(){
		$.post( "functions/dimensione/query.php", $( "#ndrysho" ).serialize(), function( data ) {
			location.reload();
		});
	}
	


</script>

<?php
include 'f.php';
?>