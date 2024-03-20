<?php


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<meta name="google-signin-client_id" content="831067773866-v55dkb3m8rs569rdhe15k4l2p2rk2ma7.apps.googleusercontent.com">
<script src="//apis.google.com/js/platform.js" async defer></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script>
function onSignIn(googleUser) {
  $.post( "functions/login/k.php", { t: googleUser.getAuthResponse().id_token } )
  .done(function( data ) {
    //console.log(data);
   if (data=="1") window.location="dash.php";
  });

}
</script>
</head>

<body>
<div class="g-signin2" data-onsuccess="onSignIn"></div>
</body>
</html>