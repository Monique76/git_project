<?php
session_start();
include("connect.php ");
$kimenet ="";
 
if(isset($_POST['termek_azon']) && $_POST['termek_azon']!==""){
	$termek_azon = $_POST['termek_azon'];

	$termek_sql = "SELECT nev FROM termekek where term_azon=".$termek_azon;
	$termekinfo = mysql_query($termek_sql) or die(mysql_error());
	
	if(mysql_num_rows($termekinfo)<1){
		header("Location:view.php");
		exit();
	}else{
		$termek_nev = mysql_result($termekinfo,0,'nev');
		
		$kocsiba = "INSERT INTO kosar VALUES('','".session_id()."','".$_POST['termek_azon']."',
		'".$_POST['megr_menny']."','".$_POST['megr_meret']."','".$_POST['megr_szin']."','".date("Y-m-d H:i:s")."')";
		mysql_query($kocsiba);
		
		header("Location:kocsi.php");
		exit();
	}
}else{
	header("Location:view.php");
	exit();
}




?>