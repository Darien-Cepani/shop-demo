function bejmodal(titull, url, kthimi) {
    $(".modal-dialog").css("max-width", "800px");
    $(".modal-body").css("padding", "10");
    $(".modal-body").html("");
    $(".modal-title").html("");
    $(".modal-title").html(titull);
    $(".vazhdo").hide();
    $(".modal-body").load(url);
    $('#myModal').modal();
}

function hapu(url, label, kthimi, gjeresi) {
    if (gjeresi) {
        $(".modal-dialog").css("max-width", gjeresi);
    }

    $(".modal-body").css("padding", "0");
    $(".modal-body").html("");
    $(".modal-title").html("");
    $(".modal-footer").show();
    $(".modal-header").show();
    $(".modal-title").html(label);
    $(".vazhdo").unbind();
    $(".vazhdo").hide();
    if (kthimi) {
        $(".vazhdo").show();
        $(".vazhdo").bind("click", function() {
            kthimi();
        });
    }

    $(".modal-body").load(url);
    $('#myModal').modal();
}


function koment(id, prindi,titulli="") {
    if (titulli=="") {titulli="Order status";}
    bejmodal(titulli, "functions/komente/koment.php?id=" + id + "&prindi=" + prindi);
}

function koment1(id, prindi) {
    $.post("functions/komente/koment1.php", $("#komentet").serialize(), function(data) {
        $("#komenti").val("");
        shikokomentet(id, prindi);
    });
}

function shikokomentet(id, prindi) {
    $.post("functions/komente/komentet.php?id=" + id + "&prindi=" + prindi, function(data) {
        $("#komentetall").html(data);
        $(".statkomente" + id).html($(".statkomente").html())
    });
}



//DARIENI



$("#shtimBtnkol").on("click", function () {
    
          var ids="";
          $('#sortable1 > div').each(function () {
            ids+=$(this).data("id") + ",";
          });
          ids = ids.replace(/,\s*$/, "");
          $("#prodIds").val(ids);
    
    $.post("functions/database/ruajKoleksion.php", $("#koleksionform").serialize(), function (result) {
        if (result == 1) {
            alert('success');
            window.location.reload();
        }
        else {
            alert('Ploteso me kujdes fushat!');
        }
    });
});

// SHTO KOLEKSION

function clickcoord(event) {
    var i = parseInt(document.getElementById("span-id").innerHTML);

    var image = document.getElementById("pointer_div");
    var tag = document.getElementById("tagged");
    var clothes = document.getElementById("cloth");

    var pos_x = event.offsetX ? (event.offsetX) : event.pageX - image.offsetLeft;
    var pos_y = event.offsetY ? (event.offsetY) : event.pageY - image.offsetTop;

    tag.style.left = (pos_x - 13).toString() + 'px';
    tag.style.top = (pos_y - 13).toString() + 'px';
    tag.style.visibility = "visible";

    clothes.style.visibility = "visible";

    document.getElementById("span-id").innerHTML = i + 1;

    document.pointform.form_x.value = pos_x;
    document.pointform.form_y.value = pos_y;
}


// Buton REMOVE TAG
function removetag(tag) {
    var t = "tags";
    $.post("functions/database/remove.php", { t: t, id: tag }, function (result) {
        console.log(result);
        window.location.reload();
    });
}

// Buton EDIT 
function edit(prodID, shoppingCart) {
    var t = "produktet";
    $.post("functions/database/edit.php", { t: t, prodID: prodID }, function (result) {
        window.location.reload();
    });
}

// Buton HIDE
$(".hide").on('click', function () {
    var id = $(this).data('id');
    var t = 'produktet';
    var hidden = 0;
    if ($(this).hasClass('fa-eye')) {
        $(this).removeClass('fa-eye');
        $(this).addClass('fa-eye-slash');
        hidden = 1;
    }
    else if ($(this).hasClass('fa-eye-slash')) {
        $(this).removeClass('fa-eye-slash');
        $(this).addClass('fa-eye');
        hidden = 0;
    }
    console.log(hidden);
    $.post("functions/database/hide.php", { t: t, hidden: hidden, id: id }, function (result) {
        console.log(result);
    });
});




// KOLEKSION DRAG N DROP

$(function () {
    $("#sortable1").sortable({
        connectWith: ".connectedSortable"
    });

    $("#sortable2").sortable({
        connectWith: ".connectedSortable"
    });
});



//lista veprime 

	function bejmodal(titull,url,kthimi='') {
	    $(".modal-body").html("");
	    $(".modal-title").html("");
		$(".modal-title").html(titull);
		$( ".vazhdo" ).unbind();
		$( ".vazhdo" ).bind( "click", function() {
		  if(kthimi) kthimi(); else $(".close").trigger("click")
		});
		$(".modal-body").load(url);
		$('#myModal').modal();
	}
	
	
    function fshi(id,t){
	    if (confirm('I sigurte?')) {
		$.post("functions/database/remove.php", { t: t, id: id }, function (result) {

		location.reload();
		});
	    }
    }