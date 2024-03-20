<?php
require_once('../functions.php');

if (!k(15)) {die("Access Denied!");}

if ($id) {
$query="SELECT * FROM multi WHERE id = {$id}";
$row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
$statusi=$row["statusi"]?$row["statusi"]:'Jo aktiv';
$emrip=$row["emri"];
$coverp=$row["cover"];
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
    <input type="hidden" name="cover" id="cover" value="<?php echo $coverp?>">  

    <div class="col py-2">
    <label >Emri</label>    
         <input type="text" id="emri" name="emri" class="form-control" value="<?php echo $emrip ?>">  
    </div>


    
        <div class="col py-2">
    <label >Statusi</label>    
           <select id="statusi" name="statusi" class="form-control" >
              <option  value="Jo aktiv">Jo aktiv</option>
              <option  value="Aktiv">Aktiv</option>
              <option  value="Kopertine">Kopertine</option>
            </select>
    </div>
    
    
    
      <div class="col py-2">
        <div style="width:150px;height:150px;background:#ccc;" id="coverdiv"></div>
        <div style="position:absolute;width:150px;height:150px;top:0;"><iframe src="functions/coverupload/upload.php" width="150" height="150" frameborder="0" scrolling="no" ></iframe></div>
       
    </div>
    







<script>

function merrumeselect(emri,value) {
    $("#" + emri).val(value).change();
} 

merrumeselect("statusi","<?php echo $statusi?>");


       function shfaqcover() {
         var foto=document.getElementById("cover").value;
         var coversrc="<?php echo $imazheUrl; ?>media/-150-150-" + foto;
         document.getElementById("coverdiv").innerHTML="<img src='" +coversrc+ "'/>";
       }
       

       if ($("#cover").val()!="") {
       shfaqcover();
       }
       
   </script>
    

    </div>
    </form>