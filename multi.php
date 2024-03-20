<?php
require_once('functions/functions.php');
include 'h.php';


$arr=[];

if ($id) {
$query="SELECT * FROM multi WHERE id = {$id}";
$row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
$arr=json_decode($row["ids"]);
}


?>
<style>
.p-nr span {
    color: #fff;
    font-weight: 400;
    font-family: "Roboto";
    font-size: 1.6em;
}
.p-nr {
    position: absolute;
    width: 2.625em;
    height: 2.625em;
    border-radius: 50%;
    background-color: #2686C6;
    display: flex;
    align-items: center;
    justify-content: center;
}
.p-image {
    position: relative;
}
body {
    margin:0;
}

.product-desc {
    position:relative;
}


 .product-desc-row {
    margin-bottom: 0;
}

 .product-desc-row {
    padding: 20px;
    border-bottom: 1px solid #b9bbbd;
}
.product-desc-row {
    width: 100%;
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
}
.number {
    width: 5.5vw;
    flex-shrink: 0;
}
.p-about {
    flex-grow: 1;
}
 .p-name {
    margin-bottom: 5px;
}
.p-price {
    font-family: "Roboto";
    font-weight: 400;
    font-size: 13px;
    color: #808184;
}
.p-name p {
    font-family: "Roboto";
    font-weight: 500;
    font-size: 15px;
    color: #000;
    line-height: 1.3em;
    margin-top: -0.2em;
}
.number span {
    display: block;
    font-family: "Roboto";
    font-weight: 500;
    font-size: 21px;
    color: #2686c6;
    line-height: 1.3em;
    margin-top: -0.2em;
}
</style>
<div class="row"  style="background:#F8F8F8;">
    <div class="col-sm" style="background:#E0E0E0;">
<div class="p-image" style="max-width:500px;" ondrop="drop(event)" ondragover="allowDrop(event)">
        <img id="img" src="<?php echo $imazheUrl; ?>media/-500-0-<?php echo $row["cover"];?>" width="100%">
             <?php 
             $i=0;
             foreach($arr as $key => $item){ 
             $kords=explode(",",$item[1]);
             if ($item[0]!="") {
                 $i++;
             ?>
              <div data-ids="<?php echo $item[0]?>" class="p-nr" style="top:<?php echo $kords[1]?>%;left:<?php echo $kords[0]?>%;">
                  <span><?php echo $i?></span>
                  <a href="javascript:;" data-id="<?php echo $item[0]?>" class="hiq" title="remove" style="position:absolute;left:-5px;top:-5px;color:#ff0000;">
                              <i class="fa fa-times"></i>
                </a>
                  </div>
             <?php }} ?>
</div>
</div>
<div class="col-sm">
   <div id="listaprod" class=" py-4">   
        <?php 
        $i=0;
        foreach($arr as $key => $item){ 
        $id1=$item[0];
        $kords=$item[1];
        if ($id1) {
            $i++;
        $sql = "SELECT * FROM produktet where id={$id1}";
		        foreach($conn->query($sql) as $row) { 
		          $fototArr = explode(",",$row['fotot']);
		          $cmimi = number_format($row['cmimi']);
              $cmimiSale = number_format($row['cmimiSale']);
        ?>
        
 
            
            <div id="t<?php echo $id1;?>" data-ids="<?php echo $id1;?>" data-kords="<?php echo $kords;?>" class="product-desc produkte">
                
                    <div class="product-desc-row">
                        
                        <div class="number">
                            <span class="radha"><?php echo $i?></span>
                        </div>
                        <div class="p-about">
                            <div class="p-name">
                                <p><?php echo $row['emri'];?> <?php echo $row['marka'];?></p>
                            </div>
                            <div class="p-price">
                                <span class="current-price">
                                    <?php echo $cmimi;?> <?php echo $monedha;?>
                                </span>
                            </div>
                        </div>
                        <div class="product-action">
                            <img src="<?php echo $imazheUrl; ?>media/-100-100-<?php echo $fototArr[0];?>" width="50" >
                        </div>

                    </div>
                        
                        
 
                </div>
            
            
            
            
          
        <?php }}} ?>
    
    
    </div>
    
    </div>
</div>

<div class="row py-4">
    <div class="col">
        <a href="multiliste.php" class="btn btn-primary">Vazhdo</a>
    </div>
</div>
<textarea id="template" style="display:none;">
    <div class="p-nr" style="top:^top^%;left:^left^%;"><span>^nr^</span>
    <a href="javascript:;" data-id="0" class="hiq" title="remove" style="position:absolute;left:-5px;top:-5px;color:#ff0000;">
                              <i class="fa fa-times"></i>
                </a>
    </div>
    </textarea>
<input type="hidden" id="id" value="<?php echo $id?>">

<script>

$( "#listaprod" ).sortable({
    update: function (evt, ui) {
        bejupdate();
    }
});

$(document).on("click",".hiq",function () {
    $("#t" + $(this).data("id")).remove();
    $(this).parent().remove();
    bejupdate();
})

function bejupdate() {
        var ids=[];
        var kords=[];
        $(".produkte").each(function(index,element) {
            $(this).find(".radha").html(index+1);
            ids.push($(this).data("ids"));
            kords.push($(this).data("kords"));
        });
        var id=$("#id").val();
        var ids1=ids.join(',');
        var kords1=kords.join('~');
        
         $.post( "functions/multi/queryndrysho.php", {id:id,ids:ids1,kords:kords1}, function( data ) {
			location.reload();
		});
}

var i=<?php echo $i+1?>;
$(document).ready(function() {
    $("#img").on("click", function(event) {
        bounds=this.getBoundingClientRect();
        var left=bounds.left;
        var top=bounds.top;
        var x = event.pageX - left;
        var y = event.pageY - top;
        var cw=this.clientWidth
        var ch=this.clientHeight
        var iw=this.naturalWidth
        var ih=this.naturalHeight
        var px=Math.round((x/cw*iw-20)/iw*100);
        var py=Math.round((y/ch*ih-20)/ih*100);
        var template=$("#template").val();
        template=template.replace("^nr^",i);
        i++;
        
        template=template.replace("^top^",py);
        template=template.replace("^left^",px);
        $(".p-image").append(template);
        
        shtoProdukt(px,py);
    });
});





	function shtoProdukt(px,py) {
		bejmodal("Zgjidh Produktin","functions/multi/shtopika.php?id=<?php echo $id?>&px=" + px + "&py=" + py,ndrysho1);
	}
	function ndrysho1(){
	    console.log($( "#ndrysho" ).serialize());
	    $.post( "functions/multi/queryshto.php", $( "#ndrysho" ).serialize(), function( data ) {
	        //alert('Sukses!');
			location.reload();
		});
	}
	
	
  $( function() {
    $( ".p-nr" ).draggable({
      stop: function(event, ui) {
        var x = ui.position.left;
        var y = ui.position.top;
        var iw=$("#img").width();
        var ih=$("#img").height();
        var px=Math.round((x/iw)*100);
        var py=Math.round((y/ih)*100);
        
        $("#t" + $(this).data("ids")).data("kords",px + "," + py);
        bejupdate();
      }
    });
  } );
	

</script>

<?php
include 'f.php';
?>