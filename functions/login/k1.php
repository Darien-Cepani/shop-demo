<?php 
header('P3P: CP="CAO PSA OUR"');
session_start();

require_once("../connstr.php");

function pastro($value,$key="")
{
	if (is_array($value)) { 
			$value=join(",",$value);
	}
    $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
    $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");


    return str_replace($search, $replace, $value);
}


$ip= $_SERVER['REMOTE_ADDR'];




require_once("../connstr.php");





$u=pastro($_REQUEST["username"]);
$p=md5(pastro($_REQUEST["password"]));


//if (strpos($lista,"|".$ip."|")>-1) {

    $sql="SELECT * FROM timekeepers where username like '{$u}' and password like '{$p}' limit 0,1";
  
    foreach($conn->query($sql) as $row) {
        	$_SESSION['username']=$row["username"];
	        $_SESSION['role']=$row["role"];
	        $_SESSION['usernameid']=$row["id"];
	        $_SESSION['id']=$row["id"];
	        $_SESSION['emri']=$row["emri"];
         $_SESSION['tarifa']=$row["tarifa"];

	
	
    foreach($conn->query("SELECT user,moduli FROM privilegje where user='{$row["role"]}'") as $rowpriv) { 
     $str.="|" . $rowpriv["moduli"] . "|"; 
     }
    
    $_SESSION['niveli']=$str;       
    

    header('Location: ../../slips.php');
    
    
    
    
    die();
        
    }


?>