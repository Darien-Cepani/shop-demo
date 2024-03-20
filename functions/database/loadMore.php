<?php 
require('../functions.php');

$fillo = $_REQUEST['f'];
$limit=30;

$sql = "SELECT * FROM produktet {$_SESSION["shtosql"]} ORDER BY id DESC LIMIT $fillo, $limit";
$result = mysqli_query($conn, $sql);
$produkte = mysqli_fetch_all($result, MYSQLI_ASSOC);

?><?php foreach ($produkte as $produkt){
            $fototArr = explode(",",$produkt['fotot']);
            $tags=explode(",",$produkt['tags']);
              $str="";
              foreach ($tags as $tag) {
              $str.=tagslug($tag) ." ";
              }
          ?>
            <tr class="produkti produkt-cart <?php echo $str;?>" id="prod-card" data-tag="<?php echo $str;?>" data-cmimi="<?php echo $produkt['cmimi']?>">
                  <td class="prod-list-img">
                    <a href="detajeProdukti.php?id=<?php echo $produkt['id'];?>">
                    <img src="<?php echo $imazheUrl; ?>media/-300-300-<?php echo $fototArr[0];?>" class="prod-img-cart">
                  </td>
                  <td>
                    <a href="detajeProdukti.php?id=<?php echo $produkt['id'];?>">
                    <div class="prod-cart-detail">
                      <h1 class="prod-cat"><?php echo $produkt['tags'];?></br></h1>
                      <h1 class="prod-brand"><?php echo $produkt['tags']; ?> / <span id="prod-name" class="prod-name"><?php echo $produkt['emri'];?></span></h1>
                    </div>
                  </td>
                <td class="prod-price-cart">
                  <div class="price-list">
                  <h1 class="prod-sale" style="font-weight: bold;"><?php echo $produkt['cmimi'];?> LEK</h1>
                    <?php 
                    if ($produkt['cmimiSale'] > 0){
                    echo "<h1 class='prod-price strikeout'>{$produkt['cmimiSale']} LEK</h1>";}
                    ?>
                  </div>
                </td>
                <td class="remove-cart">
                  <a id="removeBtn" onclick="remove(<?php echo $produkt['id'];?>)" class="addtocart"><i class="remove fas fa-trash-alt"></i></a>
                  <a id="editBtn" href="shtoProdukte.php?id=<?php echo $produkt['id'];?>" class="addtocart"><i class="edit fas fa-pen-square"></i></a>
                </td>
            </tr>
          <?php } ?>