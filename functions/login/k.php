<?php 
header('P3P: CP="CAO PSA OUR"');
session_start();

$json = file_get_contents('https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=' . $_REQUEST['t']);
$obj = json_decode($json);


if ($obj->email) {

require_once("../connstr.php");
//require_once("../functions.php");


$email=$obj->email;

$foto=$obj->picture;


    $sql="SELECT * from admins where email like '" . $email . "' limit 0,1";
    foreach($conn->query($sql) as $row) {
		if ($row["email"]) {
			$_SESSION['foto']=$foto;
			$_SESSION['username']=$email;
			$_SESSION['usernameid']=$row["id"];
			$_SESSION['emri']=$row["fullname"];
			$_SESSION["email"]=$email;
			$ip=$_SERVER['REMOTE_ADDR'];
			echo "1";
		}

	}
}

?>