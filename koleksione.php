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





$cmimi_s=merrvar("cmimi_s");
if ($cmimi_s) {
        $cmimi=explode("-",$cmimi_s);
        $cmimi1=trim($cmimi[0]);
        $cmimi2=trim($cmimi[1]);
        if (is_numeric($cmimi1) && is_numeric($cmimi2) ) {
        	$kerko.=" AND cmimi>={$cmimi1} AND cmimi<={$cmimi2} ";
        }
}


if ($id) {
	$kerko.=" and id={$id} ";
}



?>			  
    
<div class="row  py-3 kokeinfo">
<div class="col">     
<form method="get" >
<div class="row" style=""> 




<?php

$arr=array("Titull"=>"titull_s","Nentitull"=>"nentitull_s");

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
                <th>Cover</th>
                <th>Titull</th>
                <th>Nentitull</th>
                <th>Status</th>
                <th>Veprimi</th>
</tr>
</thead>
		<tbody>
		<?php
		$i=0;
		$sql = "SELECT * FROM koleksionet {$kerko} ORDER BY id DESC";
		foreach($conn->query($sql) as $row) { 
		$statusi=$row["statusi"]?$row["statusi"]:'Jo aktiv';
		if ($statusi=="Jo aktiv") { $shto="style='background:#fce4ec'";}
		if ($statusi=="Aktiv") { $shto="style='background:#e0f2f1'";}
		if ($statusi=="Kopertine") { $shto="style='background:#b2dfdb'";}
		?>
			<tr  <?php echo $shto;?>>
                <td ><?php echo $row['id'];?></td>
                <td><img src="<?php echo $imazheUrl; ?>media/-200-0-<?php echo $row["cover"];?>" class="prod-img-cart"></td>
                <td><?php echo $row['titull'];?></td>
                <td><?php echo $row['nentitull'];?></td>
                <td ><?php echo $statusi;?></td>
				<td nowrap>


<a href="koleksione-popullo.php?id=<?php echo $row['id'];?>" class="btn btn-info btn-xs" ><i title="Popullo" class="ikon icon-eye"></i></a>

 <a href="javascript:ndrysho('<?php echo $row['id'];?>')" class="btn btn-warning btn-xs" ><i title="Edit" class="ikon icon-pencil"></i></a>

 <a href="javascript:fshi('<?php echo $row['id'];?>','koleksionet')" class="btn btn-danger btn-xs"><i title="Delete" class="ikon icon-close"></i></a>

					
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
		bejmodal("Shto koleksion","functions/koleksione/edit.php",ndrysho1);
	}
	
	function ndrysho(id) {
		bejmodal("Ndrysho koleksion","functions/koleksione/edit.php?id=" +id,ndrysho1);
	}
	


	function ndrysho1(){
		$.post( "functions/koleksione/query.php", $( "#ndrysho" ).serialize(), function( data ) {
			location.reload();
		});
	}
	


   $('#koha1_s').daterangepicker({
        autoApply:false,
       "alwaysShowCalendars": true,
       timePicker: true,
       timePicker24Hour: true,
       opens: 'right',
             ranges: {
           'Today': [moment().startOf("day"), moment().endOf("day")],
           'Yesterday': [moment().subtract(1, 'days').startOf("day"), moment().subtract(1, 'days').endOf("day")],
           'Last 7 days': [moment().subtract(6, 'days').startOf("day"), moment().endOf("day")],
           'Last 30 days': [moment().subtract(29, 'days').startOf("day"), moment().endOf("day")],
           'This month': [moment().startOf('month').startOf("day"), moment().endOf('month').endOf("day")],
           'Previous month': [moment().subtract(1, 'month').startOf('month').startOf("day"), moment().subtract(1, 'month').endOf('month').endOf("day")]
        },
        locale: {
            format: 'YYYY-MM-DD HH:mm'
        }
    });
    
    $('#koha1_s').val('<?php echo $_REQUEST["koha1_s"]?>');
            
  $('#koha1_s').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm'));
  });

  $('#koha1_s').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });
 
  $('#koha1_s').attr('autocomplete', 'off');	



	

</script>

<?php
include 'f.php';
?>