<?php 
require_once('../conn.php');
require_once('../functions.php');        

$kerko = "WHERE true ";

if ($id) {
    $sql = "SELECT * FROM koleksionet where id={$id}";
    foreach($conn->query($sql) as $row) {
    $kerko.= " and id in ({$row['prodIds']}) ";
    }
}else{

    $kerkoJo=array("cmimiSale_s","id");
    
    foreach ($_REQUEST as $key => $value){
        if ($key == 'search') {break;} 
        if (!in_array($key,$kerkoJo)) {
        $kerko.=searchcope($key,$value);
        }
    }
    

    $outlet_s=merrvar("cmimiSale_s");
    if ($outlet_s=="Po") { 
        $kerko.=" AND cmimiSale>0 ";
    } elseif ($outlet_s=="Jo") {
        $kerko.=" AND cmimiSale<1 ";
    }

}    







        		$sql = "SELECT * FROM produktet {$kerko} ORDER BY id DESC";

		        foreach($conn->query($sql) as $row) { 
		          $fototArr = explode(",",$row['fotot']);
		          $cmimi = number_format($row['cmimi']);
              $cmimiSale = number_format($row['cmimiSale']);
        ?>
        
            <div class="produkti prod-card" data-cmimi="<?php echo $row['cmimi']?>" data-id="<?php echo $row['id'];?>" style="position:relative">
                <button type="button" class="hiqprodukt" style="position:absolute;right:0;top:0;display:none" >×</button>
                
              <img src="<?php echo $imazheUrl; ?>media/-300-300-<?php echo $fototArr[0];?>" class="prod-img">
              <div>
                <div><?php echo $row['emri'];?></div>
                <span><?php echo $row['tags']; ?> <?php echo $row['marka'];?></span>
                <div class="price">
                    
                  <span ><?php echo $cmimi;?> <?php echo $monedha;?></span>
                  <?php 
                    if ($row['cmimiSale'] > 0){
                        $sa=round(($row['cmimiSale']-$row['cmimi'])/$row['cmimiSale'] * 100);
                    echo "<span class='strike' style='color:#ff0000'>(-" .$sa. "%)</span>";}
                  ?>
                </div>
              </div>
            </div>
          
        <?php } ?>