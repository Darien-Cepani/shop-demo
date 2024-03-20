<?php
require_once('functions/functions.php');
include 'h.php';


if ($coverTipi=='video') {
    $videocheck=" checked ";
}else{
    $imazhcheck=" checked ";
}


?>
<div class="container">
<div class="row py-4">
    <div class="col">
        
       <table class="table table-bordered ">
           <tr>
               <td align="right" >Emri</td>
               <td>
                    <form class="form-inline">
                    <input type="text" id="emri" name="emri" class="form-control" value="<?php echo $emri?>">
                    <button type="button" id="ndryshoEmri" class="btn btn-primary vazhdo" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>
           <tr>
               <td align="right" >Logo</td>
               <td> <iframe src="functions/logo/uplogo.php" width="320" height="210" frameborder="0" ></iframe> </td>
           </tr>

           <tr>
               <td align="right" >Favicon</td>
               <td> <iframe src="functions/icon/upicon.php" width="320" height="210" frameborder="0" ></iframe> </td>
           </tr>

           <tr>
               <td align="right" ><input class="tipi" type="radio" id="imazh" name="covertype" value="imazh" <?php echo $imazhcheck?>> Kopertina Imazh
               </td>
               <td><iframe id="coverimazh" class="iframe" src="functions/cover/" width="320" height="210" frameborder="0" ></iframe></td>
           </tr>
           <tr>
               <td align="right" ><input class="tipi" type="radio" id="video" name="covertype" value="video" <?php echo $videocheck?>> Kopertine Video

               </td>
               <td><iframe src="functions/cover/upvideo.php" width="320" height="210" frameborder="0" ></iframe></td>
           </tr>          
           <tr>
               <td align="right" >Monedha</td>
               <td>
                    <form class="form-inline">
                    <input type="text" id="monedha" name="monedha" class="form-control" value="<?php echo $monedha?>">
                    <button type="button" id="ndryshoMonedha" class="btn btn-primary vazhdo" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>    
           <tr>
               <td align="right" >Telefon</td>
               <td>
                    <form class="form-inline">
                    <input type="text" id="tel" name="tel" class="form-control" value="<?php echo $tel?>">
                    <button type="button" id="ndryshoTel" class="btn btn-primary vazhdo" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>   
           
           <tr>
               <td align="right" >Email</td>
               <td>
                    <form class="form-inline">
                    <input type="text" id="email" name="email" class="form-control" value="<?php echo $email?>">
                    <button type="button" id="ndryshoEmail" class="btn btn-primary vazhdo" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>
           
           
           
           
           

           <tr>
               <td align="right" >Pershkrimi</td>
               <td>
                    <form class="form-inline">
                    <textarea id="pershkrim" name="pershkrim" style="width:100%;" class="form-control fusha1" ><?php echo $pershkrim?></textarea>  
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr> 
           
            <tr>
               <td align="right" >Pershkrim per produkt</td>
               <td>
                    <form class="form-inline">
                    <textarea id="pershkrimprodukt" name="pershkrimprodukt" style="width:100%;" class="form-control fusha1" ><?php echo $pershkrimprodukt?></textarea>  
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>  


            <tr>
               <td align="right" >Pershkrim per shporten</td>
               <td>
                    <form class="form-inline">
                    <textarea id="pershkrimshporta" name="pershkrimshporta" style="width:100%;" class="form-control fusha1" ><?php echo $pershkrimshporta?></textarea>  
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>  
           
           <tr>
               <td align="right" >Analytics</td>
               <td>
                    <form class="form-inline">
                    <textarea id="analytics" name="analytics" style="width:100%;" class="form-control fusha1" ><?php echo $analytics?></textarea>  
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>  
           
           

<?php 
for($i=1;$i<16;$i++) {
?>   
           <tr>
               <td align="right" >Dimension <?php echo $i?></td>
               <td>
                    <form class="form-inline">
                    <input type="text" id="dimension<?php echo $i?>" name="dimension<?php echo $i?>" class="form-control fusha1" value="<?php echo $dimensionetArr["dimension" . $i]?>">
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>                        
<?php } ?>           
 


           
           
            <tr>
               <td align="right" >Moduli Shporta</td>
               <td>
                    <form class="form-inline">
                    <select type="text" id="shporta" name="shporta" class="form-control fusha1" >
                        <option value="0">Jo</option>
                        <option value="1">Po</option>
                    </select>    
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr> 
           
            <tr>
               <td align="right" >Trego Cmime</td>
               <td>
                    <form class="form-inline">
                    <select type="text" id="cmim" name="cmim" class="form-control fusha1" >
                        <option value="0">Jo</option>
                        <option value="1">Po</option>
                    </select>    
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr> 
           

           <tr>
               <td align="right" >Moduli Ulje</td>
               <td>
                    <form class="form-inline">
                    <select type="text" id="ulje" name="ulje" class="form-control fusha1" >
                        <option value="0">Jo</option>
                        <option value="1">Po</option>
                    </select>    
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>  

           <tr>
               <td align="right" >Moduli Multiprodukt</td>
               <td>
                    <form class="form-inline">
                    <select type="text" id="multiprodukt" name="multiprodukt" class="form-control fusha1" >
                        <option value="0">Jo</option>
                        <option value="1">Po</option>
                    </select>    
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>  
           <tr>
               <td align="right" >Moduli Koleksione</td>
               <td>
                    <form class="form-inline">
                    <select type="text" id="koleksione" name="koleksione" class="form-control fusha1" >
                        <option value="0">Jo</option>
                        <option value="1">Po</option>
                    </select>    
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>   
           
                      <tr>
               <td align="right" >Moduli Outlet</td>
               <td>
                    <form class="form-inline">
                    <select type="text" id="outlet" name="outlet" class="form-control fusha1" >
                        <option value="0">Jo</option>
                        <option value="1">Po</option>
                    </select>    
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>  
        
                   <tr>
               <td align="right" valign="middle">Ngjyrat</td>
               <td>
                    <form class="form-inline">
                    <select type="text" id="ngjyra" name="ngjyra" class="form-control fusha1" >
                        <option value="0">Jo</option>
                        <option value="1">Po</option>
                    </select>    
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>  

           <tr>
               <td align="right" >Sizes</td>
               <td>
                    <form class="form-inline">
                    <select type="text" id="sizes" name="sizes" class="form-control fusha1" >
                        <option value="0">Jo</option>
                        <option value="1">Po</option>
                    </select>    
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>
           
           <tr>
               <td align="right" >Gjuha</td>
               <td>
                    <form class="form-inline">
                    <select type="text" id="gjuha" name="gjuha" class="form-control fusha1" >
                        <option value="al">AL</option>
                        <option value="it">IT</option>
                        <option value="en">EN</option>
                        <option value="es">ES</option>
                    </select>    
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>   

           <tr>
               <td align="right" >Cash on Delivery</td>
               <td>
                    <form class="form-inline">
                    <select type="text" id="cash" name="cash" class="form-control fusha1" >
                        <option value="0">Jo</option>
                        <option value="1">Po</option>
                    </select>    
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>

           <tr>
               <td align="right" >Paypal</td>
               <td>
                    <form class="form-inline">
                    <select type="text" id="paypal" name="paypal" class="form-control fusha1" >
                        <option value="0">Jo</option>
                        <option value="1">Po</option>
                    </select>    
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>
            <tr>
               <td align="right" >CC</td>
               <td>
                    <form class="form-inline">
                    <select type="text" id="cc" name="cc" class="form-control fusha1" >
                        <option value="0">Jo</option>
                        <option value="1">Po</option>
                    </select>    
                    <button type="button" class="btn btn-primary fusha2" style="display:none"  >Ndrysho</button>
                    </form>
                </td>
           </tr>          
        </table>       
        
        
</div>
</div></div>

<script type="text/javascript">
 var frame = document.getElementsByClassName("iframe");
 var auto_resize_timer = window.setInterval("autoresize_frames()", 400);
 function autoresize_frames() {
   for (var i = 0; i < frame.length; ++i) {
       if(frame[i].contentWindow.document.body){
         var frame_size = frame[i].contentWindow.document.body.offsetHeight;
         if(document.all && !window.opera) {
           frame_size = frame[i].contentWindow.document.body.scrollHeight;
         }
         frame[i].style.height = frame_size + 'px';
       }
   }
 }
 
$("#emri").on('keyup',function() {
    $("#ndryshoEmri").show();
})

$("#monedha").on('keyup',function() {
    $("#ndryshoMonedha").show();
})
$("#tel").on('keyup',function() {
    $("#ndryshoTel").show();
})

$("#email").on('keyup',function() {
    $("#ndryshoEmail").show();
})

$(".fusha1").on('focus',function() {
    $(this).next().show();
})

$(".fusha2").on("click",function() {
    var val=$(this).prev().val();
    var cila=$(this).prev().attr("id");
    var str=cila + "=" + val;
         $.post("functions/database/parametra.php", str, function (result) {
             console.log(result);
             window.location.reload();
        });
})


 
$("#ndryshoMonedha").on("click",function() {
    var monedha=$("#monedha").val();
    if (monedha) {
         $.post("functions/database/parametra.php", {monedha: monedha}, function (result) {
             window.location.reload();
        });
    }
})

$("#ndryshoEmri").on("click",function() {
    var emri=$("#emri").val();
    if (emri) {
         $.post("functions/database/parametra.php", {emri: emri}, function (result) {
             window.location.reload();
        });
    }
})

$("#ndryshoTel").on("click",function() {
    var tel=$("#tel").val();
    if (tel) {
         $.post("functions/database/parametra.php", {tel: tel}, function (result) {
             window.location.reload();
        });
    }
}) 

$("#ndryshoEmail").on("click",function() {
    var email=$("#email").val();
    if (email) {
         $.post("functions/database/parametra.php", {email: email}, function (result) {
             window.location.reload();
        });
    }
}) 


$(".tipi").on("click",function() {
    var ke=$(this).val();
    if (ke) {
         $.post("functions/database/parametra.php", {coverTipi: ke}, function (result) {
             window.location.reload();
        });
    }
}) 
 
 
function merrumeselect(emri,value) {
    $("#" + emri).val(value).change();
} 



merrumeselect("ngjyra","<?php echo $ngjyrat?>");
merrumeselect("sizes","<?php echo $sizes?>");
merrumeselect("ulje","<?php echo $ulje?>");
merrumeselect("multiprodukt","<?php echo $multiprodukt?>");
merrumeselect("koleksione","<?php echo $koleksione?>");
merrumeselect("outlet","<?php echo $outlet?>");
merrumeselect("shporta","<?php echo $shporta?>");
merrumeselect("gjuha","<?php echo $gjuha?>");
merrumeselect("cash","<?php echo $cash?>");
merrumeselect("paypal","<?php echo $paypal?>");
merrumeselect("cc","<?php echo $cc?>");
merrumeselect("cmim","<?php echo $cmim?>");
</script>  


<?php
include 'f.php';
?>
