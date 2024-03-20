<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();

if ($_SESSION['username']=="") {header('Location: index.php');die();exit;}
require_once("connstr.php");

