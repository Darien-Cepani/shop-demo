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



<div class="col-xs px-1 py-1">
<input type="text" id="koha1_s" name="koha1_s" value="<?php echo $koha?>" autocomplete="off" class="form-control" placeholder="Intervali Kohor">
</div> 
 

<?php

$arr=array("Emri"=>"emri_s","Tel"=>"tel_s","Email"=>"email_s","Adresa"=>"adresa_s","Qyteti"=>"qyteti_s");

foreach($arr as $key=>$value) {
    echo fushaDiv("fushe-input-no-label",$key,$value,merrvar($value));
}
?>    
  
  

	<div class="col-xs px-1 py-1">
    	<input type="text" class="form-control" id="totali_s" value="" name="totali_s" placeholder="Totali min-max">
    </div>
    
     <div class="col-xs  px-1 py-1">
           <select id="statusi_s" name="statusi_s" class="form-control" >
              <option  value="" selected>Statusi</option>
              <?php echo plotesoselect("SELECT id,status from statuseorders",false);?>
            </select>
    </div>  
    

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
                <th>Porosia</th>
                <th>Data e krijimit</th>
                <th>Emri</th>
                <th>Adresa</th>
                <th>Qyteti</th>
                <th>Tel</th>
                <th>Email</th>
                <th>Shenim</th>
                <th style="text-align: right; font-weight: bold;">Totali (LEK)</th>
                <th>Status</th>
                <th>Veprimi</th>
</tr>
</thead>
		<tbody>
		<?php
		$i=0;
		$sql = "SELECT * FROM orders {$kerko} ORDER BY id DESC";
		foreach($conn->query($sql) as $row) { 
		 $back1=$ngjyratStatus[$row["statusi"]];
		 $shto="style='background:{$back1}'";
		?>
			<tr >
                <td onclick="shikoShportaNew(<?php echo $row['id'];?>)"><?php echo $row['id'];?></td>
                <td><?php echo $row['data'];?></td>
                <td><?php echo $row['username'];?></td>
                <td><?php echo $row['adresa'];?></td>
                <td><?php echo $row['qyteti'];?></td>
                <td><?php echo $row['tel'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['shenim'];?></td>
                <td style="text-align: right; font-weight: bold;"><?php echo number_format($row['totali']);?></td>
                <td <?php echo $shto;?> ><?php echo $row['statusi'];?></td>
				<td nowrap>

<a  href="javascript:shikoShportaNew(<?php echo $row['id']?>)" class="btn btn-warning btn-xs" ><i title="Shporta" class="ikon icon-basket"></i></a>

<a  href="javascript:koment(<?php echo $row['id']?>,'orders')" class="btn btn-info btn-xs" ><i title="Koment" class="ikon icon-bubbles"></i></a>

 <?php if (k(31)) {?><a href="javascript:fshi('<?php echo $row['id'];?>','orders')" class="btn btn-danger btn-xs"><i title="Delete" class="ikon icon-close"></i></a><?php }?>

					
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
		window.location="produkte-shto.php";
	}
	
	
	function ndrysho(id) {
		bejmodal("Ndrysho produkt","functions/kliente/edit.php?id=" +id,ndrysho1);
	}
	
//	function shikoShporta(id) {
//		bejmodal("Shporta","functions/database/shportat.php?id=" +id,ndrysho1);
//	}

	function shikoShportaNew(id) {
		bejmodal("Shporta","functions/shporta/shportat.php?id=" +id,ndrysho1);
	}



	function ndrysho1(){
		//$.post( "functions/database/ruaj.php", $( "#ndrysho" ).serialize(), function( data ) {
			location.reload();
		//});
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