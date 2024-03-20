<?php
require_once('../functions.php');


if ($id) {
$query="SELECT * FROM sizes WHERE id = {$id}";
$row90 = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
$tags=$row90["tag"];
}


?>
<style>
label {
    opacity:0.4;
    font-size:0.8em;
}
</style>

    <form id="ndrysho" name="ndrysho">
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
 
    <div class="col py-2">
    <label >tags</label>    
            <select name="tag[]" id="tag" class="form-control" multiple>
            <?php 
              $sql="SELECT distinct (emri) from dimensione";
              foreach($conn->query($sql) as $row2) { 
                  if (strpos("," . $tags . ",",",".$row2["emri"].",")>-1) {$sht="selected";} else {$sht="";}
              ?>
              <option value="<?php echo $row2["emri"]?>" <?php echo $sht?>><?php echo $row2["emri"]?></option>
            <?php  } ?>
          </select>
    </div>


    <div class="col py-2">
    <label >Sizes</label>    
         <input type="text" id="sizes" name="sizes" class="form-control" value="<?php echo $row90["sizes"]?>">  
    </div>
    

    



<script>

function merrumeselect(emri,value) {
    $("#" + emri).val(value).change();
} 



      $('#tag').select2({
        'tags':true,
        'width':'100%',
        'placeholder': "Shto tags"});
        
   </script>
    

    </div>
    </form>