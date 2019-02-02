<?php

include("connect.php");
$kimenet ="";

$kategoriak = "select * from kategoriak";


$result_kategoriak = mysql_query($kategoriak);
if(mysql_num_rows($result_kategoriak)<1){
	$kimenet .="Sajnos nem találtam egy kategóriát sem!";
}else{
	while($kategoria = mysql_fetch_array($result_kategoriak)){
		$kat_azon = $kategoria["kat_azon"];
		$kat_nev = $kategoria["kat_nev"];
		$kat_leiras = $kategoria["kat_leiras"];
		$kimenet .= "<a href=\"$_SERVER[PHP_SELF]?kat_azon=$kat_azon\"><br \>$kat_nev</a><br />$kat_leiras<br />";
		
		if(isset($_GET["kat_azon"]) && $_GET["kat_azon"]==$kat_azon){
			$termekek = "SELECT * FROM termekek where kat_azon=$kat_azon order by nev";
			$result_termekek = mysql_query($termekek) or die(mysql_error());
			if(mysql_num_rows($result_termekek)<1){
				$kimenet .= "Nincsenek termékek ebben a kategóriában!";
			}else{
				$kimenet .= "<ul>";
				while($termek = mysql_fetch_array($result_termekek)){
					$termek_azon = $termek["term_azon"];
					$termek_nev = $termek["nev"];
					$ar = $termek["ar"];
					$kimenet .= "<li><a href=\"reszletek.php?term_azon=$termek_azon\">$termek_nev</a> ($ar Ft)</li>";
				}
				$kimenet .="</ul>";
			}
		}
	}	
}

		
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Termékkategóriák!</title>
</head>
<body>
<h1>Válassz egy kategóriát! </h1>
	<?php echo $kimenet; ?>
</body>