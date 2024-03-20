<?php
require_once('../functions.php');



?>
<style>
label {
    opacity:0.7;
    font-size:1.2em;
}
.input-icon {
  position: relative;
}

.input-icon > i {
  position: absolute;
  display: block;
  transform: translate(0, -50%);
  top: 50%;
  pointer-events: none;
  width: 25px;
  text-align: center;
  font-style: normal;
}

.input-icon > input {
  padding-left: 25px;
  padding-right: 0;
}

.input-icon-right > i {
  right: 0;
}

.input-icon-right > input {
  padding-left: 0;
  padding-right: 25px;
  text-align: right;
}
</style>

    <form id="ndrysho" name="ndrysho">
    <input type="hidden" id="idt" name="idt" value="0">
    <input type="hidden" id="shumaulur" name="shumaulur" value="0">
    <input type="hidden" id="saprodukte" name="saprodukte" value="0">
    
    
    <div class="col-12 py-2">
    <label >Titulli *</label>    
         <input type="text" id="shenim" name="shenim" class="form-control" value="" />  
    </div>

    <div class="col-2 py-2">
    <label >Ulje </label>   
    
    <div class="input-icon input-icon-right">
              <input type="number" id="ulja" name="ulja" class="form-control" value="0" style="text-align:right;" />  
              <i>%</i>
            </div>
      
    </div>
    
    <div class="col-5 py-2" style="color:#ff0000;font-size:1.3em;">
    Ulja e kryer eshte <span style="color:#ff0000;font-size:1.1em;" id="uljatotal">0</span>
    </div>
  


    
    
    
    <div class="col-12 py-2">
    <label >Query</label>    
         <input type="text" id="query" name="query" value="" class="form-control"> 
    </div>


</form>

<script>
var ids=$("#ids").val().split(",");
$("#idt").val(ids.join(","));

$("#query").val($("#query_s").val());

$("#saprodukte").val(ids.length);

var total=$("#total").val();
$("#ulja").on("keyup",function() {
    var sa=$(this).val()/100 * total;
    $("#uljatotal").html($(this).val()/100 * total);
    $("#shumaulur").val(sa);
})


</script>