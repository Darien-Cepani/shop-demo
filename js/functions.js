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
    if (titulli=="") {titulli="Comment";}
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


