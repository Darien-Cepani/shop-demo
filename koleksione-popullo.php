<?php
require_once('functions/functions.php');
include 'h.php';

		$sql = "SELECT * FROM koleksionet where id={$id}";
		foreach($conn->query($sql) as $row) { 
		  $titull=$row["titull"];
		  $nentitull=$row["nentitull"];
		}


?>
<style>
.sort1 button {
  display:block!important;
}
</style>
<form>
    <input type="hidden" id="id" value="<?php echo $id?>">
   </form>
    
    
    <div class="row py-4" >
      <div class="col">
        <h4><?php echo $titull?></h4>
        <h5><?php echo $nentitull?></h5>
        
      </div>
      <div class="col">
          
      <form id="ndrysho">
      <div class="row">
    
   
 <?php for($i=1;$i<7;$i++) { if ($dimensionetArr["dimension" . $i]) {?> 
          <div class="col-xs  px-1 py-1">
          <select name="dimension<?php echo $i?>_s[]" id="dimension<?php echo $i?>_s" class="form-control kerko" multiple>
            <?php 
              $sql="SELECT distinct (emri) from dimensione where lloji like 'dimension{$i}' order by emri asc";
              foreach($conn->query($sql) as $row2) { 
              ?>
              <option value="<?php echo $row2["emri"]?>" <?php echo $sht?>><?php echo $row2["emri"]?></option>
            <?php  } ?>
          </select>
        </div>
<?php }} ?>  
    
        <div class="col-xs px-1 py-1">
    	<input type="text" class="form-control kerko" id="ulje_s" value="" name="ulje_s" placeholder="Uljet min-max">
    </div>


        <div class="col-xs  px-1 py-1">
           <select id="cmimiSale_s" name="cmimiSale_s" class="form-control kerko" >
              <option value="">Zgjidh Outlet</option>
              <option value="">Te gjitha</option>
              <option value="Po">Po Outlet</option>
              <option value="Jo">Jo Outlet</option>
            </select>
    </div>
    
    
    <div class="col-xs  px-1 py-1">
           <button onclick="shtotegjitha();" class="btn btn-warning">Shto te gjitha</button>
    </div> 
        
    </div>
    </form>
    
    </div>
    </div>
    
    <div class="row" >
      
      <div class="col sort1">
        <ul id="sortable1" class=" connectedSortable"></ul>
      </div>
    <div class="col">
    	   <ul id="sortable2" class="connectedSortable"></ul>
       </div>
    </div>

 <button id="koleksionPop"  value="vazhdo" class="btn btn-primary">Vazhdo</button>
 

<script>

 
  	$(document).ready(function() {
     <?php for($i=1;$i<7;$i++) { if ($dimensionetArr["dimension" . $i]) {?>  
      $('#dimension<?php echo $i?>_s').select2({
        'placeholder': "<?php echo $dimensionetArr["dimension" . $i]?>"});
      <?php }} ?>  

        });
    



$(".kerko").on('change',function() {
  	$.post( "functions/koleksione/liste-ajax.php", $( "#ndrysho" ).serialize(), function( data ) {
			$("#sortable2").html(data);
		});
});



$.post( "functions/koleksione/liste-ajax.php", {id: <?php echo $id ?>}, function( data ) {
			$("#sortable1").html(data);
});


$('body').on('click', '.hiqprodukt', function() {
    $(this).parent().remove();
});


$("#koleksionPop").on('click',function() {
          var id=$("#id").val();
          var ids="";
          $('#sortable1 > div').each(function () {
            ids+=$(this).data("id") + ",";
          });
          ids = ids.replace(/,\s*$/, "");

          $.post( "functions/koleksione/popullo.php", {ids: ids,id: id}, function( data ) {
            window.location="koleksione.php";
          });
          
});


function shtotegjitha() {
  
  $('#sortable2 > div').each(function () {
            $('#sortable1').append($(this));
  });
  
}

</script>





<?php    
include 'f.php';
?>    