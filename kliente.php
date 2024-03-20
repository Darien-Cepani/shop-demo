<?php
require_once('functions/functions.php');
include 'h.php';

if (!k(29)) {die("Access Denied!");}	

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


<?php if (k(33)) {?>
 <button  onclick="shto();" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored shtim">
  <i class="material-icons">add</i>
</button>
 <?php } ?>   
  
    
<?php 

$kerko=" WHERE id<>-1 ";

$kerkoJo=array("last_interaction_s","created_time_s");

foreach ($_REQUEST as $key => $value){
    if ($key == 'search') {break;} 
    if (!in_array($key,$kerkoJo)) {
    $kerko.=searchcope($key,$value);
    }
}


if ($id) {
	$kerko.=" and id={$id} ";
}

if (k(32)) {
	$kerko.=" AND timekeeper like '{$_SESSION["username"]}' ";
}


?>			  
    
<div class="row  py-3 kokeinfo">
<div class="col">     
<form method="get" >
<div class="row" style=""> 



    
 

<?php

$arr=array("Emri"=>"emri_s","Nickname1"=>"nickname1_s","Nickname2"=>"nickname2_s","Tel"=>"tel_s","Email"=>"email_s");

foreach($arr as $key=>$value) {
    echo fushaDiv("fushe-input-no-label",$key,$value,merrvar($value));
}
?>    
  
  
   <div class="col-xs  px-1 py-1">
           <select id="vat_s" name="vat_s" class="form-control" >
              <option  value="" selected>VAT</option>
              <option  value="PO" >PO</option>
              <option  value="JO" >JO</option>
            </select>
    </div>


    <div class="col-xs  px-1 py-1">
           <select id="arrangement_s" name="arrangement_s" class="form-control" >
              <option  value="" selected>Arrangement</option>
              <?php echo plotesoselect("SELECT id,arrangement from arrangements order by arrangement asc",false);?>
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
<th>ID</th>
<th>Emri</th>
<th>Nicknames</th> 
<th>Email</th>        
<th>Tel</th>       
<th>Adresa</th>
<th>Arrangements</th>
<th>VAT</th>
<th>Shenime</th>
<th>Veprimi</th> 
</tr>
</thead>
		<tbody>
		<?php
		$i=0;
		
		foreach($conn->query("SELECT * FROM kliente " . $kerko ) as $row) { 
		if ($row["active"]=="N") { $shto="style='background:#FFD3CE'";}else{$shto="";}
		?>
			<tr  <?php echo $shto;?>>
				<td <?php echo $shto;?> ><?php echo ++$i; ?></td>
				<td><?php echo $row['emri']?>
				<?php echo $row['master']?"<br/><strong>".$row['master']."</strong>":""; ?>
				</td>
				<td><?php echo $row['nickname1']?>, <?php echo $row['nickname2']?></td>
                <td><?php echo $row['email']?></td>
				<td><?php echo $row['tel']; ?></td>
				<td>
				<?php echo $row['adresa']; ?>
				<?php echo $row['adresa2']?"<br/>".$row['adresa2']:""; ?>
				<?php echo $row['qyteti']?"<br/>".$row['qyteti']:""; ?>
				<?php echo $row['shteti']?", ".$row['shteti']:""; ?>
				</td>
				<td><?php echo $row['arrangement']; ?></td>
				<td><?php echo $row['vat']; ?></td>
				<td><?php echo $row['shenime']; ?></td>
				<td nowrap>

<?php if (k(30)) {?><a href="javascript:ndrysho('<?php echo $row['id']?>')" class="btn btn-warning btn-xs" ><i title="Edit" class="ikon icon-pencil"></i></a><?php }?>
 <?php if (k(31)) {?><a href="javascript:fshi('<?php echo $row['id'];?>')" class="btn btn-danger btn-xs"><i title="Delete" class="ikon icon-close"></i></a><?php }?>

					
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
	

	function bejmodal(titull,url,kthimi) {
	    $(".modal-body").html("");
	    $(".modal-title").html("");
		$(".modal-title").html(titull);
		$( ".vazhdo" ).bind( "click", function() {
		  kthimi();
		});
		$(".modal-body").load(url);
		$('#myModal').modal();
	}


	function shto() {
		bejmodal("Shto Klient","functions/kliente/edit.php",ndrysho1);
	}
	
	
	function ndrysho(id) {
		bejmodal("Ndrysho Klient","functions/kliente/edit.php?id=" +id,ndrysho1);
	}

	function ndrysho1(){
		$.post( "functions/kliente/query.php", $( "#ndrysho" ).serialize(), function( data ) {
			
			location.reload();
		});
	}
	
	function fshi(id){
	    if (confirm('I sigurte?')) {
		$.post( "functions/kliente/delete.php?id=" + id, function( data ) {
			location.reload();
		});
	    }
	}
	
	

</script>

<?php
include 'f.php';
?>