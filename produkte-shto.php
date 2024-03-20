<?php
require_once('functions/functions.php');

if ($id) {
  $head="Ndrysho Produkt:";
  $button="EDITO PRODUKT";
} else {
  $head="Shto Produkt:";
  $button="SHTO PRODUKT";
}

if ($id) {
$sql = "SELECT * FROM produktet where id={$id}";
$result = $conn->query($sql);
$produkt = $result->fetch(PDO::FETCH_ASSOC);
$ngjyra=$produkt["ngjyra"];
for ($i=1;$i<16;$i++) {
  if ($dimensionetArr["dimension" . $i]) {
    $arrVleraDimension["dimension" . $i]=$produkt["dimension" . $i];
  }
}

}

$val1 = $produkt['kategoria'];
$val2 = $produkt['gjinia'];

if ($id){
  $selected = "selected";
  $hidden = "";
} else{
  $selected = "";
  $hidden = "hidden";
}

?>

<?php
include 'h.php';
?>


 <style>
 label1 {
    opacity: 0.4;
    font-size: 0.8em;
 }
 </style>


    <div class="row py-4">
    <div class="col">
    <form id="shtimi" class="form" method="post">
      <input type="hidden" name="id"  value="<?php echo $produkt['id'];?>">
      <input type="hidden" name="t" value="produktet">
        <div class="form-group">
          <label1>Emri</label1>
          <input type="text" class="form-control" placeholder="EMRI I PRODUKTIT *" name="emri" id="emri" required value="<?php echo $produkt['emri'];?>" />
        </div>

<?php for($i=1;$i<=16;$i++) { if ($dimensionetArr["dimension" . $i]) {?> 
         <div class="form-group" required>
           <label1><?php echo $dimensionetArr["dimension" . $i]?></label1>
          <select name="dimension<?php echo $i?>[]" id="dimension<?php echo $i?>" class="form-control dimensionet" multiple>
            <?php 
            $all="";
              $sql="SELECT distinct (emri) from dimensione where lloji like 'dimension{$i}' order by emri asc";
              foreach($conn->query($sql) as $row2) { 
                $all.=$row2["emri"] . "|";
                  if (strpos("," . $arrVleraDimension["dimension" . $i] . ",",",".$row2["emri"].",")>-1) {$sht="selected";} else {$sht="";}
              ?>
              <option value="<?php echo $row2["emri"]?>" <?php echo $sht?>><?php echo $row2["emri"]?></option>
            <?php  } ?>
          </select>
          <input type="hidden" id="dimension<?php echo $i;?>help" value="<?php echo rtrim($all,"|");?>">
        </div>
<?php }} ?>






<?php 
if ($ngjyrat==1) {?>
        <div class="form-group" required>
          <select name="ngjyra[]" id="ngjyra" class="form-control" multiple>
            <?php 
              $sql="SELECT distinct (ngjyra) from ngjyra where ngjyra<>''";
              foreach($conn->query($sql) as $row2) { 
                  if (strpos("," . $ngjyra . ",",",".$row2["ngjyra"].",")>-1) {$sht="selected";} else {$sht="";}
              ?>
              <option value="<?php echo $row2["ngjyra"]?>" <?php echo $sht?>><?php echo $row2["ngjyra"]?></option>
            <?php  } ?>
          </select>
        </div>
<?php } ?>        
        
        <div class="form-group">
          <div class="row">
            <div class="col">
              <label1>Cmimi para</label1>
              <input type="number" class="form-control" placeholder="CMIMI PARA ZBRITJES" name="cmimiSale" id="cmimiSale" value="<?php echo $produkt['cmimiSale'];?>"/>
            </div>
            <div class="col">
              <label1>Cmimi Aktual</label1>
                <input type="number" class="form-control" placeholder="CMIMI AKTUAL *" name="cmimi" id="cmimi" required value="<?php echo $produkt['cmimi'];?>"/>
              </div>
          </div>
        </div>
        
        
        
        
        
        <div class="form-group">
          <textarea class="form-control" rows="3" placeholder="PËRSHKRIMI *" name="pershkrimi" id="pershkrimi" required><?php echo $produkt['pershkrimi'];?></textarea>
        </div>
        
        
        
        

        

        
        <input type="hidden" name="fotot" id="fotot" value="<?php echo $produkt['fotot'];?>">
        
   </form>
   
   </div>
   <div class="col">
   <div id="fototdiv" style="display:flex; justify-content: center; flex-wrap: wrap;"></div>
   
    <textarea  id="templateupload" style="display:none">
      <div><iframe class="add-img" src="functions/upload/upload.php" width="200" height="200" frameborder="0" scrolling="no" ></iframe></div>
    </textarea> 
    
      <textarea class="images" name="template" id="template" style="display:none">
        <div class="img-container">
          <img class="img-preview thumbs" src="~foto~" data-src="~fotobase~" width="200">
          
          
          <a href="javascript:hiq('~fotohiq~')" class="" title="remove" style="position:absolute;right:-5px;top:-5px;color:#ff0000;">
              <i class="fa fa-times"></i>
          </a>
          
        </div>
      </textarea>
    </div>
   </div> 
    <button id="shtimBtn" value="insert" class="btn btn-primary">Vazhdo</button>
    
 
   	<script>
  	$(document).ready(function() {
      
      
     <?php for($i=1;$i<16;$i++) { if ($dimensionetArr["dimension" . $i]) {?>  
      
      $('#dimension<?php echo $i?>').select2({
        'tags':true,
        'width':'100%',
        'placeholder': "Shto <?php echo $dimensionetArr["dimension" . $i]?>"});
        
      <?php }} ?>  
        
        
        
        
    $('#marka').select2({
        'tags':true,
        'width':'100%',
        'placeholder': "Marka"});
        
        $('#ngjyra').select2({
        'tags':true,
        placeholder: "Ngjyra",
        width:'100%',
        allowClear: true
        });
        
        $( "#fototdiv" ).sortable();
    });
    
  

 $(document.body).on("change",".dimensionet",function(){
 var emri=this.value;
 var lloji=$(this).attr("id");
 
 
 var values = $("#" + lloji + "help").val().split("|");

 if (values.includes(emri)) {
   console.log("Old");
 } else {
   values.push=emri;
   $("#" + lloji + "help").val(values.join("|"));
   
    $.post("functions/dimensione/query.php",{lloji:lloji,emri:emri}, function (result) {
      
    });
    
 }

}); 
 

function merrumeselect(emri,value) {
    $("#" + emri).val(value).change();
} 

merrumeselect("kategoria", "<?php echo $produkt['kategoria'];?>")
    
      function shfaqfotot() {
        document.getElementById("fototdiv").innerHTML="";
        var fotot=document.getElementById("fotot").value;
        var arr=fotot.split(",");
        for (var i=0;i<arr.length;i++) {
          if (arr[i]!="") {
            ndertodiv(arr[i]);
          }
        }
        uploaddiv();
      }

      function ndertodiv(imazhi) {
        var template=document.getElementById("template").value;
        var skeda=template.replace(/~foto~/g,"<?php echo $imazheUrl; ?>media/-200-200-" + imazhi);
        skeda=skeda.replace(/~fotohiq~/g,imazhi);
        skeda=skeda.replace(/~fotobase~/g,imazhi);
        document.getElementById("fototdiv").innerHTML+=skeda;
      }

      function hiq(imazhi) {
        var fotot=document.getElementById("fotot").value.replace(imazhi + ",","");
        document.getElementById("fotot").value=fotot;
        document.getElementById("fototdiv").innerHTML="";
        shfaqfotot();
      }
      
      function uploaddiv() {
        var template=document.getElementById("templateupload").value;
        document.getElementById("fototdiv").innerHTML+=template;
      }
      
      shfaqfotot();
 
    
      
 //Buton SHTO PRODUKT
$("#shtimBtn").on("click", function () {
   var fotostr="";
  
  $( ".thumbs" ).each(function() {
  fotostr+=$(this).data("src") + ",";
  });
  
  document.getElementById("fotot").value=fotostr;

   if ($("#emri").val()=="") {alert("Ploteso emrin e produktit!");return false;}
    $.post("functions/database/ruaj.php", $("#shtimi").serialize(), function (result) {
        if (result == 1) {
            alert('Sukses!');
            //window.location.reload();
        }
        else {
            alert('Ploteso me kujdes fushat!');
        }
    });
});     
      
      
      
  	</script>   
 


<?php
include 'f.php';
?>