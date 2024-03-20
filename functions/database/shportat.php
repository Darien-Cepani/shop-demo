<?php 
require('../functions.php');

$sql = "SELECT
`shporta`.*,
`produktet`.`id`,
`produktet`.`emri`,
`produktet`.`tags`,
`produktet`.`cmimi`,
`produktet`.`marka`,
`produktet`.`fotot`
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
                <td ><?php echo $row['size'];?></td>
                <td ><?php echo $row['ngjyra'];?></td>
                <td align="right"><?php echo number_format($row['cmimi']);?></td>
                <td align="right"><?php echo $row['sasia'];?></td>
                <td align="right"><?php echo number_format($row['sasia'] * $row['cmimi']);?></td>
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
</body>
</html>