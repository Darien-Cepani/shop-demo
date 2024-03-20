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
$kamfilter=false;
$kerko=" WHERE id<>-1 ";

$kerkoJo=array("shfaq_s","cmimiSale_s");

foreach ($_REQUEST as $key => $value){
    if ($key == 'search') {break;} 
    if (!in_array($key,$kerkoJo)) {
    $kerko.=searchcope($key,$value);
    }
}

$shfaq_s=merrvar("shfaq_s");
if (strpos($shfaq_s,"-")>-1) {
        $shfaq=explode("-",$shfaq_s);
        $shfaq1=trim($shfaq[0]);
        $shfaq2=trim($shfaq[1]);
        if (is_numeric($shfaq1) && is_numeric($shfaq2) ) {
        	$kerko.=" AND shfaq>={$shfaq1} AND shfaq<={$shfaq2} ";
        }
}elseif (is_numeric($shfaq_s)){
    	$kerko.=" AND shfaq={$shfaq_s} ";
}

$outlet_s=merrvar("cmimiSale_s");
if ($outlet_s=="Po") { 
    $kerko.=" AND cmimiSale>0 ";
} elseif ($outlet_s=="Jo") {
    $kerko.=" AND cmimiSale<1 ";
}



if ($id) {
	$kerko.=" and id={$id} ";
}

if ($kerko!=" WHERE id<>-1 ") {
    $kamfilter=true;
}


?>			  
    
<div class="row  py-3 kokeinfo">
<div class="col">     
<form method="get" >
<div class="row" style=""> 



    
 

<?php

$arr=array("Emri"=>"emri_s","Kodi"=>"kodi_s");

foreach($arr as $key=>$value) {
    echo fushaDiv("fushe-input-no-label",$key,$value,merrvar($value));
}
?>    
  
  

	<div class="col-xs px-1 py-1">
    	<input type="text" class="form-control" id="cmimi_s" value="" name="cmimi_s" placeholder="Cmimi min-max">
    </div>
    
        <div class="col-xs px-1 py-1">
    	<input type="text" class="form-control" id="ulje_s" value="" name="ulje_s" placeholder="Uljet min-max">
    </div>

  
  
  
<?php for($i=1;$i<14;$i++) { if ($dimensionetArr["dimension" . $i]) {?> 
          <div class="col-xs  px-1 py-1">
          <select name="dimension<?php echo $i?>_s[]" id="dimension<?php echo $i?>_s" class="form-control" multiple>
            <?php 
              $sql="SELECT distinct (emri) from dimensione where lloji like 'dimension{$i}' order by emri asc";
              foreach($conn->query($sql) as $row2) { 
              ?>
              <option value="<?php echo $row2["emri"]?>" <?php echo $sht?>><?php echo $row2["emri"]?></option>
            <?php  } ?>
          </select>
        </div>
<?php }} ?>  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        <div class="col-xs  px-1 py-1">
           <select id="shfaq_s" name="shfaq_s" class="form-control" >
              <option value="">Shfaq</option>
              <option value="0">Mos e Shfaq</option>
              <option value="1-9">Prioritet 1-9</option>
              <option value="10">Shfaq Normal</option>
            </select>
    </div>
    
    <div class="col-xs  px-1 py-1">
           <select id="cmimiSale_s" name="cmimiSale_s" class="form-control" >
              <option value="">Zgjidh Outlet</option>
              <option value="">Te gjitha</option>
              <option value="Po">Po Outlet</option>
              <option value="Jo">Jo Outlet</option>
            </select>
    </div>  

	<div class="col-xs px-1 py-1">
    	<input type="text" class="form-control" id="pershkrimi_s" value="" name="pershkrimi_s" placeholder="Pershkrimi">
    </div>

    
    
    
    
 <div class="col">
        <button type="submit" name="search" id="search" class="btn btn-primary">Kerko</button>  
    </div>
 
 <?php if ($ulje==1) {?>   
     <div class="col" id="uljediv" style="display:none">
        <button type="button" name="uljebtn" id="uljebtn" class="btn btn-danger" onclick="ulje()">Ulje</button>  
    </div>
  <?php } ?>  
</div>
</form>
</div></div>



<div class="row px-4 py-4" style="margin-bottom:80px;"> 

<div class="col">
<div class="table-responsive">    
<table id="tabela" class="table table-striped table-bordered " width="100%">
<thead>
<tr>
<th><input type="checkbox" id="allitems"  checked></th>
<th>Kodi</th>
<th>Foto</th>
<th>Emri</th>

<?php for($i=1;$i<5;$i++) {?>   
<th><?php echo $dimensionetArr["dimension" . $i]?></th>
<?php } ?> 

<th>Pershkrimi</th>
<th>Shfaq</th>
<th>Para Zbritjes</th>
<th align="right">Ulje %</th>
<th>Cmimi</th>
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
				<td><input type="number" data-id="<?php echo $row["id"]; ?>" value="<?php echo $row["kodi"]; ?>" class="kodi" style="width:60px;outline:0;border:1;text-alegin=right;"/></td>
				<td><img data-src="<?php echo $imazheUrl; ?>media/-100-100-<?php echo $fototArr[0];?>" src="../images/paimg.jpg" class="prod-img-cart lazyload"></td>
				<td><?php echo $row['emri']?></td>

<?php for($i=1;$i<5;$i++) {?>   
<td><?php echo $row["dimension" . $i]?></td>
<?php } ?> 

				<td><?php echo $row['pershkrimi']; ?></td>
				<td>
				<select class="shfaq" data-id="<?php echo $row["id"];?>">
				    <?php for($j=0;$j<11;$j++) {
                                $jlabel=$j;
                                if ($row["shfaq"]==$j) {$kjo=" selected ";}else{$kjo="";}
if ($j==0) {$jlabel="Mos e shfaq";}
if ($j==10) {$jlabel="Normal";}
				    ?>
				    <option <?php echo $kjo?> value="<?php echo $j?>"><?php echo $jlabel?></option>
				    <?php } ?>    
				</select>
				
				</td>
				
				<td align="right"><?php echo $row['cmimiSale']; ?></td>
				<td align="right"><?php echo $row['ulje']; ?></td>
				<td align="right"><?php echo $row['cmimi']; ?></td>
				<td nowrap>

<a target="_blank" href="/produkti.php?id=<?php echo $row['id']?>" class="btn btn-info btn-xs" ><i title="Shiko" class="ikon icon-eye"></i></a>

<?php if (k(30)) {?><a href="produkte-shto.php?id=<?php echo $row['id']?>" class="btn btn-warning btn-xs" ><i title="Edit" class="ikon icon-pencil"></i></a><?php }?>
 <?php if (k(31)) {?><a href="javascript:fshi('<?php echo $row['id'];?>','produktet')" class="btn btn-danger btn-xs"><i title="Delete" class="ikon icon-close"></i></a><?php }?>

					
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
  	          
     <?php for($i=1;$i<16;$i++) { if ($dimensionetArr["dimension" . $i]) {?>  
      $('#dimension<?php echo $i?>_s').select2({
        'placeholder': "<?php echo $dimensionetArr["dimension" . $i]?>"});
      <?php }} ?>  

        });
    

function merrumeselect(emri,value) {
    $("#" + emri).val(value).change();
} 



<?php foreach ($_REQUEST as $key => $value){ ?>
merrumeselect("<?php echo $key?>","<?php echo $value?>");
<?php } ?>

<?php for($i=1;$i<=7;$i++) { if ($dimensionetArr["dimension" . $i]) {?> 
$("#dimension<?php echo $i?>_s").val( $("#dimension<?php echo $i?>_s").val().concat('<?php echo join("','",$_REQUEST["dimension" . $i . "_s"])?>') );
<?php }} ?>

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
	
	



$(".shfaq").on("change",function() {
    var id=$(this).data("id");
    var j=$(this).val();
		$.post( "functions/database/produkte-shfaq.php", {id:id,j:j}, function( data ) {
		});	
})

$(".kodi").on("change",function() {
    var id=$(this).data("id");
    var j=$(this).val();
		$.post( "functions/database/produkte-kodi.php", {id:id,vl:j}, function( data ) {
		});	
})


	function ulje() {
	    var ids=$("#ids").val().split(",");
		bejmodal("Ulje " + ids.length + " produkte","functions/produkte/ulje.php",ulje1);
	}
	


	function ulje1(){
		$.post( "functions/produkte/ulje1.php", $( "#ndrysho" ).serialize(), function( data ) {
		    if (data==1) {alert("Sukses"); }else{alert("Gabim");}
			location.reload();
		});
	}
	

$("#allitems").on("click",function() {
    console.log("Po");
    if ($(this).is(":checked")) {
        $(".checks").prop("checked",true);
    } else {
        $(".checks").prop("checked",false);
    }
    
    updatechecks();
    
})


$(".checks").on("click",function() {
    updatechecks();
})

function updatechecks() {
    var ids="";
    $(".checks").each(function(){
        if ($(this).is(":checked")) {
            ids+=$(this).data("id") + ",";
        }
    });
    $("#ids").val(ids.replace(/,\s*$/, ""));
}	

</script>
<script src="/js/lazysizes.min.js" async=""></script> 

<?php
include 'f.php';
?>