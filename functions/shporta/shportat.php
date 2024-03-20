<?php 
require('../functions.php');

$sql = "SELECT
`shporta`.`id`,
`shporta`.`prodId`,
`shporta`.`sasia`,
`shporta`.`size`,
`shporta`.`ngjyra` as ngjyrazgjedhur,
`shporta`.`shoppingCart`,
`produktet`.`emri`,
`produktet`.`tags`,
`produktet`.`cmimi`,
`produktet`.`marka`,
`produktet`.`fotot`,
`produktet`.`ngjyra`
FROM `shporta`
INNER JOIN `produktet`
ON `shporta`.`prodId` = `produktet`.`id`
WHERE owner = $id";



?>
  <!--Dashboard-->
        <table class="table ">
          <tr>
            <th>Produkti</th>
            <th></th>
            <th >Masa</th>
            <th >Ngjyra</th>
            <th style="text-align: right;">Cmimi</th>
            <th style="text-align: right;">Sasia</th>
            <th style="text-align: right;">Total</th>
          </tr>
          <?php 
          foreach($conn->query($sql) as $row) { 
            $totali += $row['sasia'] * $row['cmimi'];
            $fototArr = explode(",",$row['fotot']);
            $masat=gjejMase($row['tags']);
            
            ?>
            <tr>
                <td >
                    <a href="produkte-shto.php?id=<?php echo $row['prodId'];?>">
                    <img src="<?php echo $imazheUrl; ?>media/-100-100-<?php echo $fototArr[0];?>" class="prod-img-cart">
                  </td>
                  <td>
                    <div>
                      <?php echo $row['emri'];?>,  
                      <?php echo $row['marka']; ?>, <?php echo $row['tags'];?>
                    </div>
                  </td>
                <td >
                
                <select class="size" data-id="<?php echo $row['id'] ?>">
                    <?php $arrm=explode(",",$masat);
                    foreach($arrm as $size) {
                    if ($size==$row['size']) {$shto=" selected ";} else {$shto="";}
                    ?>
                    <option value="<?php echo $size?>" <?php echo $shto ?>><?php echo $size?></option>
                    <?php } ?>
                 </select>
                
                </td>
                <td >
                    <?php if ($row['ngjyra']!='') { ?>
                        <select style="text-transform: capitalize;" class="ngjyra" data-id="<?php echo $row['id'] ?>">
                             <option></option>
                             <?php $arrn=explode(",",$row['ngjyra']);
                             foreach($arrn as $ngjyre) {
                             if ($ngjyre!="") {
                             if ($ngjyre==$row['ngjyrazgjedhur']) {$shto=" selected ";} else {$shto="";}
                             ?>
                             <option value="<?php echo $ngjyre?>" <?php echo $shto ?>><?php echo $ngjyre?></option>
                             <?php }} ?>
                          </select>
                   <?php } ?>
                  
                </td>
                <td align="right"><?php echo number_format($row['cmimi']);?><input type="hidden" id="cmiminjesi" value="<?php echo $row['cmimi'];?>"></td>
                <td align="right"><input type="number" style="text-align:right;border:0;"; maxlength="2" size="2" id="sasia" class="sasia" name="sasia" value="<?php echo $row['sasia'];?>"  data-id="<?php echo $row['id'] ?>"></td>
                <td align="right"><span id="totalishportaSpan"><?php echo number_format($row['sasia'] * $row['cmimi']);?></span><input type="hidden" id="totalshporta" value="<?php echo $row['sasia']*$row['cmimi'];?>"></td>
            </tr>
      
          <?php } ?>
          <tr>
            <td></td>
             <td></td>
              <td></td>
              <td></td>
              <td></td>
                <td align="right"><strong>Totali:</strong></td>
              <td align="right"><strong><?php echo number_format($totali)."";?></strong></td>

          </tr>
        </table> 
<script>
$(".sasia").on("change",function() {
    var id=$(this).data("id");
    var sasia=$(this).val();
    var cmiminjesi=$("#cmiminjesi").val();
    var tot=cmiminjesi * sasia;
    $("#totalshporta").val(tot);
    $("#totalishportaSpan").html(tot.toLocaleString());
    
    
    if (id) {
         $.post("functions/database/cartupdate.php", {id: id,sasia: sasia,tot:tot}, function (result) {
             //parent.window.location.reload();
        });
    }
})


$(".size").on("change",function() {
    var id=$(this).data("id");
    var size=$(this).val();
    if (id) {
         $.post("functions/database/cartupdate.php", {id: id,size: size}, function (result) {
        });
    }
})

$(".ngjyra").on("change",function() {
    var id=$(this).data("id");
    var ngjyra=$(this).val();
    if (id) {
         $.post("functions/database/cartupdatengjyra.php", {id: id,ngjyra: ngjyra}, function (result) {
        });
    }
});
</script>