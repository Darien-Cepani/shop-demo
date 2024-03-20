<?php
require_once("conn.php");



$query="SELECT * FROM parametra order by id desc";
$rowpp = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
$emri=$rowpp["emri"]?$rowpp["emri"]:'Emri';
$monedha=$rowpp["monedha"]?$rowpp["monedha"]:'Eur';
$tel=$rowpp["tel"]?$rowpp["tel"]:'';
$email=$rowpp["email"]?$rowpp["email"]:'';
$coverTipi=$rowpp["coverTipi"]?$rowpp["coverTipi"]:'imazh';
$ngjyrat=$rowpp["ngjyra"];
$sizes=$rowpp["sizes"];
$ulje=$rowpp["ulje"];
$multiprodukt=$rowpp["multiprodukt"];
$koleksione=$rowpp["koleksione"];
$shporta=$rowpp["shporta"];
$outlet=$rowpp["outlet"];
$pershkrim=$rowpp["pershkrim"];
$pershkrimprodukt=$rowpp["pershkrimprodukt"];
$pershkrimshporta=$rowpp["pershkrimshporta"];
$gjuha=$rowpp["gjuha"]?$rowpp["gjuha"]:'al';
$cmim=$rowpp["cmim"];
$cash=$rowpp["cash"];
$paypal=$rowpp["paypal"];
$cc=$rowpp["cc"];
$analytics=$rowpp["analytics"];

for ($i=1;$i<16;$i++) {
$dimensionetArr['dimension' . $i]=$rowpp["dimension" . $i];
}



$id = $_REQUEST['id'];
if ($id) {if (!is_numeric($id)){die();}} 
$i = $_REQUEST['i'];
if ($i) {if (!is_numeric($i)){die();}} 
$j = $_REQUEST['j'];
if ($j) {if (!is_numeric($j)){die();}}
$nr = $_REQUEST['nr'];
if ($nr) {if (!is_numeric($nr)){die();}} 
$sa = $_REQUEST['sa'];
if ($sa) {if (!is_numeric($sa)){die();}} 



$ngjyratStatus=array('I ri'=>'#fffde7','Spam'=>'#a1887f','Ne proces'=>'#e6ee9c','Sukses'=>'#a5d6a7','Deshtuar'=>'#ffccbc');

$t=merrvar("t");
$tabela=$t;
$prindi=pastro($_REQUEST["prindi"]);


if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    $shopProtocol = 'https://';
}
else {
  $shopProtocol = 'http://';
}

$shopHost=$_SERVER['HTTP_HOST'];


$imazheUrl="https://cdnimpuls.com/{$shopHost}/";


$kolonat=[];
$kolonatkoment=[];
if ($tabela!="") {
        foreach($conn->query("SHOW FULL COLUMNS FROM {$tabela}" ) as $rowf) { 
            $arr=[];
            if ($rowf["Field"]!="id") {
                $arr=[$rowf["Field"],$rowf["Comment"]];
                array_push($kolonat,$arr);
                
                if ($rowf["Comment"]!="") {
                    $arr=[$rowf["Field"]=>merrvlerakomenti($rowf["Comment"])];
                    array_push($kolonatkoment,$arr);
                }
                
            }
        }
}



function merrKolona($tabela) {
    $arr=[];
        foreach($GLOBALS["conn"]->query("SHOW FULL COLUMNS FROM {$tabela}" ) as $rowf) { 
            if ($rowf["Field"]!="id") {
                $arr[]=$rowf["Field"];
            }
        }
return $arr;
}


function slug($kete) {
return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $kete)));
}

function tagslug($kete) {
return strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', ' ', $kete)));
}




function merrvlerakomenti($str) {
$arr=[];
foreach($GLOBALS["conn"]->query($str) as $row) { 
    $arr[$row[0]]=$row[1];
}
return $arr;
}

function pastro($value,$key="")
{
	if (is_array($value)) { 
			$value=join(",",$value);
	}
    $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
    $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");


    return trim(str_replace($search, $replace, $value));
}



function plotesoselect($sql,$vlere=false) {
    if ($sql=="") {return "";}
$str .= <<<EOD
EOD;
foreach($GLOBALS["conn"]->query($sql) as $row) { 

if ($vlere) {
$str .= <<<EOD
        <option value="{$row[0]}">{$row[1]}</option>
EOD;
} else {
$str .= <<<EOD
        <option value="{$row[1]}">{$row[1]}</option>
EOD;
}

}
return $str;
}



function ekst($fileName)
{
    $lastDotPos = strrpos($fileName, '.');
    if ( !$lastDotPos ) return false;
    return substr($fileName, $lastDotPos+1);
}

function selectvalue($sql,$vlere) {
if ($sql=="") {return "";}
$str .= <<<EOD
       
EOD;
foreach($GLOBALS["conn"]->query($sql) as $row) { 
if ($vlere==$row[0]) {  $zgjedhur="selected";} else {$zgjedhur="";}
$str .= <<<EOD
        <option {$zgjedhur} value="{$row[0]}">{$row[0]}</option>
EOD;
}
return $str;
}


function checkExist($domain) {
   $curlInit = curl_init($domain);
   curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,20);
   curl_setopt($curlInit,CURLOPT_HEADER,true);
   curl_setopt($curlInit,CURLOPT_NOBODY,true);
   curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
   curl_setopt($curlInit,CURLOPT_TIMEOUT, 30); 
   $response = curl_exec($curlInit);
   $http_code = curl_getinfo( $curlInit, CURLINFO_HTTP_CODE );
   curl_close($curlInit);
   return $http_code;
}




function roles($vlere="") {
foreach($GLOBALS["conn"]->query("Select * from roles order by role asc") as $row) { 
if ($vlere==$row[1]) {  $zgjedhur="selected";} else {$zgjedhur="";}
$str .= <<<EOD
        <option {$zgjedhur} value="{$row[0]}">{$row[1]}</option>
EOD;
}
return $str;
}

function role($vlere="") {
if ($vlere) { 
foreach($GLOBALS["conn"]->query("Select * from roles where id={$vlere}") as $row) { 
    return $row[1];
}}    
return $str;
}

function ciliUser($vlere) {
if ($vlere) {
foreach($GLOBALS["conn"]->query("Select * from operatore where id={$vlere}") as $row) { 
    return $row[1];
}    
}
return $str;
}


function ciliKlient($vlere) {
if (is_numeric($vlere)) {
foreach($GLOBALS["conn"]->query("Select CONCAT(emri,' (',nickname1,' ',nickname2,')') as name from kliente where id={$vlere}") as $row) { 
    return $row["name"];
}    
}
return $str;
}




function merrvar($t) {
    return pastro($_REQUEST[$t]);
}




function merrfusha($tabela) {
    $kolonatkoment=[];
        foreach($GLOBALS['conn']->query("SHOW FULL COLUMNS FROM {$tabela}" ) as $rowf) { 
            $arr=[];
            if ($rowf["Field"]!="id") {
                if ($rowf["Comment"]!="") {
                    $jsonarr=json_decode($rowf["Comment"],true);
                    $jsonarr['fusha'] = $rowf["Field"];
                    array_push($kolonatkoment,$jsonarr);
                }
                
            }
        }
        return $kolonatkoment;
}       

function sortByRadha($a, $b) {
    return $a['radha'] - $b['radha'];
}

function merrVlereTabele($sql) {
   foreach($GLOBALS["conn"]->query($sql) as $row) {
       $arr[$row[0]]=$row[1];
   }
return $arr;
}


function histori($id,$action,$cfare,$prindi) {
	$query = "INSERT INTO histori(";
    $query .= "ku,";
    $query .= "prindi,";
    $query .= "username,";
    $query .= "emri,";
    $query .= "action,";
	$query .= "cfare";
    $query .= ") VALUES (";
    $query .= "'{$id}', ";
    $query .= "'{$prindi}', ";
    $query .= "'{$_SESSION['username']}', ";
    $query .= "'{$_SESSION['emri']}', ";
	$query .= "'{$action}', ";
	$query .= "'{$cfare}')";
$GLOBALS['conn']->query($query);   
}



function bejkoment($id,$mesazhi,$statusi,$prindi,$callback='') {
    $data = date("Y-m-d H:i:s");
	$query = "INSERT INTO mesazhe(";
    $query .= "ke,";
    $query .= "mesazhi,";
 if ($statusi) {$query .= "statusi, ";}
 if ($callback) {$query .= "callback, ";}
    $query .= "koha,";
	$query .= "foto,";
	$query .= "prindi,";
    $query .= "kush";
    $query .= ") VALUES (";
    $query .= "'{$id}', ";
    $query .= "'{$mesazhi}', ";
 if ($statusi)  {$query .= "'{$statusi}', ";}
 if ($callback)  {$query .= "'{$callback}', ";}
    $query .= "'{$data}', ";
	$query .= "'{$_SESSION['foto']}', ";
	$query .= "'{$prindi}', ";
    $query .= "'{$_SESSION['emri']}')"; 


    $result = $GLOBALS['conn']->query($query);
   
    $statusstr=megjejstatus($statusi,$prindi);

    $tani=date('Y-m-d H:i:s');
    
    if($statusi) {

    $query = "UPDATE {$prindi} SET statusi='{$statusstr}' WHERE id = {$id}";
	$GLOBALS['conn']->query($query);

    } 
    

    


		
}	


function addtask($id,$prindi,$callback) {
    
    if ($prindi=="leads") {
        $path="lead.php";
    }
     if ($prindi=="clients") {
        $path="client.php";
    }
    
    
    foreach($GLOBALS['conn']->query("select CONCAT(firstname,' ',lastname) as name from {$prindi} where id='{$id}'") as $row11) {
       $name=$row11["name"]; 
    }
    
    $titull="<a target=\'parent\' href=\'/{$path}?id={$id}\' >Call </a> {$name} ";
    $arrdata=explode("T",$callback);
    
    $query = "INSERT INTO taskslist (titull,deadline,ora,agjentiid) VALUES ('{$titull}','{$arrdata[0]}','{$arrdata[1]}','{$_SESSION['id']}')";
	$GLOBALS['conn']->query($query);  
}


function megjejstatusid($emri,$prindi) {
		foreach($GLOBALS['conn']->query("select id from statuse{$prindi} where status like '{$emri}'") as $row11) {
			$sta=$row11["id"];
		}
	return $sta;	
	}

function megjejstatus($id,$prindi) {
	$sta="";
	if (is_numeric($id)) {
		foreach($GLOBALS['conn']->query("select status from statuse{$prindi} where id={$id}") as $row11) {
			$sta=$row11["status"];
		}
		}
	return $sta;	
	}	

function gjejStatusPrindi($id,$prindi) {
	$sta="";
	if (is_numeric($id)) {
		foreach($GLOBALS['conn']->query("select statusi from {$prindi} where id={$id}") as $row11) {
			$sta=$row11["statusi"];
		}
		}
	return $sta;	
	}	



function searchcope($key,$value) {
$shto="";
$key=str_replace("_s","",$key);

   if (is_array($value)) {
       $shto.= " AND (1=0 ";
       foreach($value as $kjo) {
        $shto.= " OR lower(`{$key}`) like lower('%{$kjo}%') ";   
       } 
       $shto.= " ) ";
    } else {
    if ($value!="") {
        $value=strtolower($value);
    $shto.= " AND (lower(`{$key}`) like '%{$value}%' ";
    if (strpos($value,"-")>-1) {
        $arr=explode("-",$value);
        if (is_numeric($arr[0]) && is_numeric($arr[1])) {
        $shto.= " OR (`{$key}` >= {$arr[0]} AND `{$key}` <= {$arr[1]}) ";
        }
    } 
    $shto.= ")";
    }
    }
return $shto;
}
	
	

function bejlogsql($ip,$struktura,$user,$status) {
		$query="INSERT INTO logs(ip,user,status) VALUES ('{$ip}','{$user}','{$status}')";   
		$GLOBALS['conn']->exec($query);
}

function k($id) {
    return true;
	$kam=false;
	if (strpos(strtolower($_SESSION['niveli']),"|" . strtolower($id). "|")!==false) {$kam=true;}
	return $kam;
	}
	







function humanTiming ($time)
{
    if (!$time) return "" ;
    $time = time() - $time; 
    
    if ($time<0) {
        $shto = " from now";
    }else{
        $shto = " ago";
    }
    
    //$time = ($time<1)? 1 : $time;
    $time = abs($time);
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'') . $shto;
    }

}

function d($ke) {
    return date("d/m/Y H:i",strtotime($ke)); 
}

function d1($ke) {
    return date("d/m/Y",strtotime($ke)); 
}

function fushaDiv($template,$label,$fusha,$vlera) {
$str=file_get_contents(__DIR__ . "/templates/$template.php");    
$str = str_replace(
  array('^label^','^fusha^','^vlera^'), 
  array($label,$fusha,$vlera), 
  $str
);
return  $str;
}


function klientiinfo($id) {
 if (is_numeric($id)) {
foreach($GLOBALS["conn"]->query("Select * from kliente where id={$id}") as $row) { 
    return array($row["emri"],$row["nipt"],$row["tel"],$row["email"],$row["adresa"],$row["adresa2"],$row["qyteti"],$row["shteti"],$row["arrangement"],$row["vat"]);
}    
}
return array();
}

function gjejMase($tags) {
    $arr=explode(",",$tags);
    foreach($arr as $tag) {
        if ($tag!="") {
        foreach($GLOBALS["conn"]->query("select * from sizes where CONCAT(',',tag,',') like '%,{$tag},%'") as $row11) {
                $s=$row11['sizes'];
            }
        }
    }
   
return $s;    
}