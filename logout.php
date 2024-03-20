<?php
require_once("functions/connstr.php");
function loghyrje($user,$exten,$action) {
        $koha=date('Y-m-d H:i:s');
		$query="INSERT INTO usersonline(user,exten,koha,action) VALUES ('{$user}','{$exten}','{$koha}','{$action}')";   
		$GLOBALS['conn']->exec($query);
}
loghyrje($_SESSION['username'],$_SESSION["extension"],'logout');
        	
        	$_SESSION['username']='';
	        $_SESSION['role']='';
	        $_SESSION['usernameid']='';
	        $_SESSION['id']='';
	        $_SESSION['emri']='';
	        $_SESSION["group"]='';
	        $_SESSION["extension"]='';
header('Location: index.php');	        