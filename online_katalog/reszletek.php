<?php
include("connect.php");

$kimenet = "<h1>A termék adatai</h1>";

if(isset($_GET["term_azon"])){
	$termek_azon=$_GET["term_azon"];
	$termekek = "SELECT * FROM termekek left join kategoriak on kategoriak.kat_azon=termekek.kat_azon where termekek.term_azon=".$termek_azon."";
	$termek = mysql_query($termekek) or die(mysql_error());

	if(mysql_num_rows($termek)<1){
		$kimenet .="Érvénytelen terméket választottál";
	}else{
		$kat_azon = mysql_result($termek,0,'kat_azon');
		$kat_nev = mysql_result($termek,0,'kat_nev');
		$termek_neve = mysql_result($termek, 0, 'nev');
		$kep = mysql_result($termek,0,'kep');
		$leiras = mysql_result($termek,0,'leiras');
		$ar = mysql_result($termek,0,'ar');
		$meret = mysql_result($termek,0,'ar');
		
		$kimenet .="
				<strong><p><em>A választott termék!</em></p></strong>
				<u><a href=\"view.php?kat_azon=$kat_azon\">".$kat_nev."</a></u>&nbsp;>&nbsp;$termek_neve
		<table cellpadding=3 cellspacing=3>
			<tr>
				<td valign=middle align=center><img src=\"image/$kep\"></td>
				<td valign=middle><p><strong>Leírás:</strong></p>$leiras<br/>
				<p><strong>Ár:</strong>&nbsp;$ar&nbsp;Ft</p>
				<form action=\"kocsiba_tesz.php\" method=\"post\">";
		//lekérdezzük a színeket
		$szinek_sql = "SELECT szin FROM termek_szin where term_azon=".$termek_azon; 
		$szinek = mysql_query($szinek_sql) or die(mysql_error());
		
		if(mysql_num_rows($szinek)>0){
			$kimenet .="<strong><p>Választható színek:</p></strong>
		<select name=\"megr_szin\">";
			while ($valasztek = mysql_fetch_array($szinek)){
				$szin = $valasztek['szin']; 
				$kimenet .= "<option value=\"$szin\">$szin</option>";
			}
		$kimenet .= "</select>";
		}
		//lekérdezzük a méretet
		$meretek_sql = "SELECT meret FROM termek_meret where termek_azon=".$termek_azon;
		$meretek = mysql_query($meretek_sql) or die(mysql_error());
		
		if(mysql_num_rows($meretek)>0){
			$kimenet .="<strong><p>Választható méretek:</p></strong>
			<select name=\"megr_meret\">";
			while($meret_valasztek=mysql_fetch_array($meretek)){
				$meret = $meret_valasztek['meret'];
				$kimenet .="<option value=\"$meret\">$meret</option>";
			}
			$kimenet .="</select>";
		}
		
		$kimenet .="<strong><p>Mennyiség:</p></strong>
		<select name=\"megr_menny\">";
		for($i=1;$i<10;$i++){
			$kimenet .="<option value=\"$i\">$i</option>";
		}
		$kimenet .="</select>
		<input type=\"hidden\" name=\"termek_azon\" value=\"$termek_azon\">
		<input type=\"submit\" name=\"submit\" value=\"Mehet a kocsiba\">";
		$kimenet .="</td></tr></table>";
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

