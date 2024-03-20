<?php require_once("functions/functions.php");?>
<?php require_once("h.php");
if (!k($tabela ."-list")) {die("Access Denied!");}
?>

<style>
.shtim {
    position: fixed;
    display: block;
    right: 0;
    bottom: 0;
    margin-right: 40px;
    margin-bottom: 40px;
    z-index: 900;
}
.mdl-button--fab {
    border-radius: 50%;
    font-size: 24px;
    height: 56px;

    min-width: 56px;
    width: 56px;
    padding: 0;
    overflow: hidden;
    box-shadow: 0 1px 1.5px 0 rgba(0,0,0,.12), 0 1px 1px 0 rgba(0,0,0,.24);
    line-height: normal;
}
.mdl-button--fab.mdl-button--colored {
    background: #ff4081;
    color: #fff;
}
.mdl-button {
    border: none;
    font-family: "Roboto","Helvetica","Arial",sans-serif;

    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0;

    will-change: box-shadow;
    transition: box-shadow .2s cubic-bezier(.4,0,1,1),background-color .2s cubic-bezier(.4,0,.2,1),color .2s cubic-bezier(.4,0,.2,1);
    outline: none;
    text-decoration: none;
    text-align: center;
    vertical-align: middle;
}
</style>





<?php


if (k($tabela ."-add")) {?>
 <button  onclick="shto();" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored shtim" title="Shto Vlera">
  <i class="material-icons">add</i>
</button>
<?php } ?>

<div class="container-fluid">
<div class="row px-4 py-4" style="margin-bottom:100px;"> 
<div class="col">

<div id="kujam" style="display:block; margin-bottom:20px;">
<h3><?php echo ucfirst($tabela)?></h3>
</div>


<div class="table-responsive">
<table id="tabela" class="table table-striped table-bordered ">
<thead>
<tr>
<th>ID</th>

    <?php foreach ($kolonat as $kolona) { ?>  
        <th><?php echo ucfirst($kolona[0])?></th>
    <?php } ?>
   
<th>Action</th> 
</tr>
</thead>
		<tbody>
		<?php
		$i=0;
		
		foreach($conn->query("SELECT * FROM {$tabela} {$shtim} order by id desc" ) as $row) { 
		$mekoment=0;
		?>
			<tr  <?php echo $shto;?>>
				<td <?php echo $shto;?> ><?php echo ++$i; ?></td>
				
				
	<?php foreach ($kolonat as $kolona) { ?>  
        <td><?php
        if ($kolona[1]=="") {
        if ($kolona[0]=="foto") {	
        echo "<img style='min-width:60px;' src='" . $row[$kolona[0]] ."'/>";
        } else {
         echo $row[$kolona[0]];	
        }
        
        }else{
        echo merrVlereTabele($kolona[1])[$row[$kolona[0]]];
        }
        ?></td>
    <?php } ?>

<td nowrap>

<?php if (k($tabela ."-akses") && false) {?>
<a href="javascript:privilegje('<?php echo $row['id']?>','<?php echo $row[1]?>')"  class="btn btn-info btn-xs" ><i  class="ikon icon-lock"></i></a>
<?php } ?>

<?php if (k($tabela ."-edit")) {?>
<a href="javascript:ndrysho('<?php echo $row['id']?>')" class="btn btn-warning btn-xs"><i title="Ndrysho" class="ikon icon-pencil"></i></a>
<?php } ?>

<?php if (k($tabela ."-delete")) {?>
<a href="javascript:fshi('<?php echo $row['id'];?>')"  class="btn btn-danger btn-xs"><i title="Fshi" class="ikon icon-close"></i></a>
<?php } ?>
				</td>
			</tr>
<?php } ?>
		</tbody>
	</table>
</div></div></div></div>



<script>
var t='<?php echo $tabela?>';
	function bejmodal(titull,url,kthimi) {
	    $(".modal-body").html("");
	    $(".modal-title").html("");
		$(".modal-title").html(titull);
		$( ".vazhdo" ).unbind();
		$( ".vazhdo" ).bind( "click", function() {
		  kthimi();
		});
		$(".modal-body").load(url);
		$('#myModal').modal();
	}


	function shto() {
		bejmodal("ADD","functions/crud/edit.php?t=" + t,ndrysho1);
	}
	
	
	function ndrysho(id) {
		bejmodal("Edit","functions/crud/edit.php?id=" + id + "&t=" + t,ndrysho1);
	}

	function ndrysho1(){
		$(".vazhdo").attr("disabled", "disabled");
		$.post( "functions/crud/query.php", $( "#ndrysho" ).serialize(), function( data ) {
			location.reload();
		});
	}
	
	function fshi(id){
	    if (confirm('I sigurte?')) {
		$.post( "functions/crud/fshi.php?id=" + id + "&t=" + t, function( data ) {
			location.reload();
		});
	    }
	}


	function privilegje(id,kush) {
		bejmodal("Roles","functions/privilegje/privilegje.php?id=" + id,privilegje1);
	}
	
	function privilegje1(){
		$(".vazhdo").attr("disabled", "disabled");

		$.post( "functions/privilegje/privilegje1.php", $( "#ndrysho" ).serialize(), function( data ) {
		location.reload();
		});
	}	


</script>



<?php require_once("f.php");?>