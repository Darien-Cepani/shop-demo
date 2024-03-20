<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <base href="/app/" />
    <title>CRMX - <?php echo $GLOBALS["name"]?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Extended">
    <link rel="stylesheet" href="css/simple-line-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styles.css">

<script src="js/jquery-3.4.1.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>




<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="js/datetimepicker/css/daterangepicker.css" />
<script type="text/javascript" src="js/datetimepicker/js/moment.min.js"></script>
<script type="text/javascript" src="js/datetimepicker/js/daterangepicker.js"></script>
<script type="text/javascript" src="js/functions.1.js"></script>
   <link href="js/select2/select2.min.css" rel="stylesheet" />
<script src="js/select2/select2.min.js"></script>
    

    <style>
* {
  font-family: "Roboto","Helvetica","Arial",sans-serif;
  font-size:14px;
}    
    
    
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      
@media (min-width: 576px) {

}
.koka {
    height:56px;
}
.forco {
font-size: 1rem!important; 
   background-color: transparent!important; 
  line-height: 12px!important;
}  

.dropdown-menu.show {
  transform: translate3d(0px, 26px, 0px)!important;
}
.ui-widget.ui-widget-content {
    z-index: 1031!important;
}

.ui-menu .ui-menu-item {
    margin: 10px!important;
    cursor: pointer;
    text-transform: capitalize!important;
}

	.ui-autocomplete-category {
		font-weight: bold;
		padding: .2em .4em;
		margin: .8em 0 .2em;
		line-height: 1.5;
	}
.hije {
    -webkit-transition: top cubic-bezier(0.4,0.0,0.2,1) .2s;
    transition: top cubic-bezier(0.4,0.0,0.2,1) .2s;
    -webkit-box-shadow: 0 3px 4px 0 rgba(0,0,0,.14), 0 3px 3px -2px rgba(0,0,0,.2), 0 1px 8px 0 rgba(0,0,0,.12);
    box-shadow: 0 3px 4px 0 rgba(0,0,0,.14), 0 3px 3px -2px rgba(0,0,0,.2), 0 1px 8px 0 rgba(0,0,0,.12);
    border: 0;
    z-index: 999;
    background-color: #000!important;
}





.taskContainer {
    background-color: white;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    height: 100%;
    width: 300px;
}
.taskover {
    transition-duration: 0ms;
    transition-timing-function: cubic-bezier(0.4,0,0.2,1);
    box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.2);

    bottom: 0;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    z-index:2;
    background:#fff;

    top: 0;
    transition-property: width;
        box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.2);
        width:300px; 
        height:100%;
        position:fixed;
        right:-300px;top:0;bottom:0;
        z-index:999999;
}

.nav-link {
     display: inline;
    }
    
    </style>
  </head>
  <body>

    


    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark hije">
  <a class="navbar-brand" href="dash.php">
  <?php if (strpos($logomaster,"/img/")>-1) { ?>
  <img src="<?php echo $logomaster?>" height="30"> 
  <?php }else{ ?>
    <img src="../icons/logo.svg" height="30"> <span style="color:#ffffff;font-size:12px!important;"></span> 
   <?php } ?>
    </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">

<?php if (k(55)) {?>
      <li class="nav-item">
        <a class="nav-link" href="dash.php">Dashboard</a>
      </li>
<?php } ?> 


<?php if (k(14)  || k(18)) {?>
      <li class="nav-item">
        <a class="nav-link" href="produkte.php">Produkte</a>
      </li>
<?php } ?>  

<?php if (k(22) || k(28) ) {?>
      <li class="nav-item">
        <a class="nav-link" href="porosi.php">Porosi</a>
      </li>
<?php } ?>  
 

<?php if ($koleksione==1) {?>      
      <li class="nav-item">
        <a class="nav-link" href="koleksione.php">Koleksione</a>
      </li>
<?php } ?> 


<?php if ($multiprodukt==1) {?>      
      <li class="nav-item">
        <a class="nav-link" href="multiliste.php">Multiprodukt</a>
      </li>
<?php } ?> 


  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle forco" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dimensionet</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
               <?php 
                for($i=1;$i<=16;$i++) {
                  if ($dimensionetArr["dimension" . $i]) {?>
                  <a class="dropdown-item" href="dimensione.php?d=<?php echo $i?>"><?php echo $dimensionetArr["dimension" . $i]?></a>
              <?php }} ?>   
        
        
      </li>





<?php if ($sizes==1) {?>      
      <li class="nav-item">
        <a class="nav-link" href="sizes.php">Sizes</a>
      </li>
<?php } ?> 
<?php if ($ngjyrat==1) {?>     
      <li class="nav-item">
        <a class="nav-link" href="ngjyra.php">Ngjyra</a>
      </li>
<?php } ?> 

<?php if ($ulje==1) {?>      
      <li class="nav-item">
        <a class="nav-link" href="ulje.php">Uljet</a>
      </li>
<?php } ?> 


<?php if (k(1)) {?>      
      <li class="nav-item">
        <a class="nav-link" href="parametra.php">Parametra</a>
      </li>
<?php } ?> 






 


       <li class="nav-item">
        <a class="nav-link" href="logout.php">Dil</a>
      </li>     
      
    </ul>


    <div style="width:450px;margin-right:50px;">
    <input id="searchall" class="form-control" placeholder="Kerko" >
    
    <a class="task"></a>
      </div>

  </div>
</nav>


<script>

$( ".dropdown-menu" ).each(function( index ) {
if ($(this).children().length > 0 ) {
  
} else {
  $(this).parent().hide();
}
});


    	$( function() {
		$.widget( "custom.catcomplete", $.ui.autocomplete, {
			_create: function() {
				this._super();
				this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
			},
			_renderMenu: function( ul, items ) {
				var that = this,
					currentCategory = "";
				$.each( items, function( index, item ) {
					var li;
					if ( item.category != currentCategory ) {
						ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
						currentCategory = item.category;
					}
					li = that._renderItemData( ul, item );
					if ( item.category ) {
						li.attr( "aria-label", item.category + " : " + item.label );
					}
				});
			}
		});

		 $("#searchall").catcomplete({
			delay: 0,
			source: "functions/search/index.php",
			   select: function( event, ui ) { 
            window.location.href = ui.item.value;
        }
		});
	} );



$(".task").on("click",function() {
   //$("#tasklista").prop("src","tasks/list.php");
   $(".taskover").animate({"right":"0px"}, "fast");
})

function mbyllTask() {
   $(".taskover").animate({"right":"-300px"}, "fast");
}




</script>


<main role="main">

  <div class="koka">

  </div>

  <div class="container-fluid">



