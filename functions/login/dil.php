<?php
session_start();
$_SESSION['foto']=NULL;
	$_SESSION['username']=NULL;
	$_SESSION['niveli']=NULL;
	$_SESSION['usernameid']=NULL;
	$_SESSION['emri']=NULL;
	$_SESSION["email"]=NULL;
	$_SESSION["agenzia"]=NULL;
header('Location: ../../index.php');	