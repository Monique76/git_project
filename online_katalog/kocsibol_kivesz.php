<?php
session_start();
include("connect.php");
if(isset($_GET['kosar_azon']) && $_GET['kosar_azon'] != ""){
	$azon = $_GET['kosar_azon'];
	echo $azon;
	$torles_sql = "DELETE FROM kosar where kosar_azon=".$azon;
	$torles = mysql_query($torles_sql) or die(mysql_error()); 
	header('Location:kocsi.php');
	exit();
}else{
	header('Location:view.php');
	exit();
}
?>