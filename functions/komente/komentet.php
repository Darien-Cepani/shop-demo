<?php
require_once('../functions.php');

?>
<div class="row-fluid">
    <div class="col">
<ul style="list-style-type: none;padding-left: 0;">

                                     
<?php
foreach($conn->query("SELECT * FROM mesazhe where ke={$id} and prindi like '{$prindi}' order by id desc") as $row2) { ?>  


  <li class="margin-bottom:10px;"  id="kush<?php echo $row2["id"]?>">
    <div class="row py-2">
  
     <div class="col-12">
         
      <div class="badge badge-secondary" style="float:right;clear:both;font-size:11px"><?php echo $row2["koha"]?> - <?php echo megjejstatus($row2["statusi"],$prindi)?></div>
     
          
         <div class="" style="padding:10px;background-color: #eff1f3;     font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;">
        <b style="color: #365899;"><?php echo $row2["kush"]?></b>  
        
        <?php 
        
        if ($row2["callback"]!='0000-00-00 00:00:00' && $row2["callback"]!='' ) {
            echo "<br><div class='badge badge-danger'>Call back: " . $row2["callback"] . "</div><br>"; 
        }
        
        echo $row2["mesazhi"]?>
        </br>
       
       <?php if (k(54)) { ?><a style="color:#ffffff;float:right;" data-id="<?php echo $row2["id"]?>" title="Delete" class="btn btn-danger btn-xs fshikoment">X</a><?php } ?> 
      
      </div>
      
    
        </div>
    </div>
    

  </li>

           
                         
<?php } ?>
</ul>
</div></div>

<script>
$(".fshikoment").on("click",function() {
    var id=$(this).data("id");
    if (confirm('Are you sure?')) {
    $.post("functions/komente/fshi.php?id=" + id, function(data) { 
        $( "#kush" + id ).hide();
    })
    }
})
</script>