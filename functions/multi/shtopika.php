<?php
require_once('../functions.php');

//if (!k(15)) {die("Access Denied!");}

if ($id) {
$query="SELECT * FROM multi WHERE id = {$id}";
$row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
}


?>
<style>
label {
    opacity:0.4;
    font-size:0.8em;
}
.select2-container {
width: 100% !important;
}
.select2-search__field {
    width: 100% !important;
}
</style>

 <div class="row">
 
     <div class="col  px-3 py-1">
           <select id="tags_s" name="tags_s[]" class="form-control kerko" multiple>
              <?php echo plotesoselect("SELECT id,tags from produktet group by tags",false);?>
            </select>
    </div>  
    

    <div class="col  px-1 py-1">
           <select id="marka_s" name="marka_s[]" class="form-control kerko" multiple >
              <?php echo plotesoselect("SELECT id,marka from marka",false);?>
            </select>
    </div>  

    <div class="col  px-1 py-1">
           <select id="kategoria_s" name="kategoria_s[]" class="form-control kerko" multiple >
            <?php echo plotesoselect("SELECT id,kategori from kategori",false);?>
            </select>
    </div> 

        <div class="col  px-1 py-1">
           <select id="cmimiSale_s" name="cmimiSale_s" class="form-control kerko" >
              <option value="">Zgjidh Outlet</option>
              <option value="">Te gjitha</option>
              <option value="Po">Po Outlet</option>
              <option value="Jo">Jo Outlet</option>
            </select>
    </div>
    
</div>

<div class="row">
<ul id="sortable2" class="connectedSortable"></ul>
</div>

    <form id="ndrysho" name="ndrysho">
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
    <input type="hidden" name="ids" id="ids" value="">
    <input type="hidden" name="kords" id="kords" value="<?php echo $_REQUEST["px"] . "," . $_REQUEST["py"] ?>">
    </form>

<script>
 	$(document).ready(function() {
          $('#tags_s').select2({placeholder: 'Tags'});
          $('#marka_s').select2({placeholder: 'Marka'});
          $('#kategoria_s').select2({placeholder: 'Kategoria'});
    });


$(document).on('click','.produkti', function() {
    $("#ids").val($(this).data("id"));
    ndrysho1();
});

$(".kerko").on('change',function() {
   
   var tag=$("#tags_s").val();
   var marka=$("#marka_s").val();
   var kategoria=$("#kategoria_s").val();
   var cmimiSale_s=$("#cmimiSale_s").val();
  
  	$.post( "functions/koleksione/liste-ajax.php", {tags:tag,marka:marka,kategoria:kategoria,cmimiSale_s:cmimiSale_s}, function( data ) {
			$("#sortable2").html(data);
		});
});

</script>