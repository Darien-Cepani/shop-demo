<?php
require_once('functions/functions.php');
include 'h.php';
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
<h4>Uljet</h4>
</div></div>


<div class="container-fluid">
<div class="row px-4 py-4"> 

<div class="col">
<div class="table-responsive">    
<table id="tabela1" class="table table-striped table-bordered " width="100%">
<thead>
<tr>
                <th>Id</th>
                <th>Koha</th>
                <th>Shenim</th>
                <th>Ulja %</th>
                <th>Ulja shuma</th>
                <th>Produkte</th>
                <th>Query</th>
                <th>Veprimi</th>
</tr>
</thead>
		<tbody >
		<?php
		$i=0;
		$sql = "SELECT * FROM ulje ORDER BY id desc";
		foreach($conn->query($sql) as $row) { 
		?>
			<tr >
                   <td class="handle" ><?php echo $row["id"];?></td>

                <td><?php echo $row['koha'];?></td>
                <td><?php echo $row['shenim'];?></td>
                <td><?php echo $row['ulja'];?></td>
                <td><?php echo $row['shumaulur'];?></td>
                <td><?php echo $row['saprodukte'];?></td>
                <td><?php echo $row['query'];?></td>
				<td nowrap>
<a href="produkte-uljelist.php?uljeid_s=<?php echo $row['id'];?>" class="btn btn-info btn-xs" ><i title="Produktet" class="ikon icon-eye"></i></a>
 <a href="javascript:fshiuljen('<?php echo $row['id'];?>')" class="btn btn-danger btn-xs"><i title="Delete" class="ikon icon-close"></i></a>
				</td>
			</tr>
<?php } ?>
		</tbody>
	</table>
</div></div></div>

</div>

<script>






var tabela=$('#tabela').DataTable({
    dom: 'Bfrtip',
        buttons: [
             'excel','csv'
        ],
        "pageLength": 50,
        "order": [],
         
    
});
	






	
		function fshiuljen(id){
			if (confirm('Fshirja kthen produktet ne cmimin e meparshem. I sigurte?')) {
		$.post( "functions/produkte/uljefshi.php", {id:id}, function( data ) {
		    console.log(data);
		    location.reload();
		});
			}
	}
	


</script>

<?php
include 'f.php';
?>