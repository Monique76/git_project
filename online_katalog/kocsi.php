<?php
session_start();
//kiírjuk a kosár tartalmát, szépen táblázatosansession_start();
include("connect.php ");
$kimenet ="Az Ön bevásárlókocsija!";

$kocsi_tart_sql = "SELECT * FROM kosar as k left join termekek
				   as t on k.term_azon=t.term_azon";
$kosar = mysql_query($kocsi_tart_sql) or die(mysql_error());

if(mysql_num_rows($kosar)<1){
	$kimenet .="Az Ön beváráslókocsija üres! 
				A vásárlást folytathatja <a href=\"view.php\">itt folytathatja</a>";
}else{
		$kimenet .="<table celpadding=3 celspacing=2 border=1 width=98%>
		<tr>
			<th>Név</th>
			<th>Méret</th>
			<th>Szín</th>
			<th>Ár</th>
			<th>Menny</th>
			<th>Összesen</th>
			<th>Törlés</th>
		</tr>";
		while ($sor = mysql_fetch_array($kosar)){ 
		$kosar_azon = $sor['kosar_azon'];
		$nev = $sor['nev'];
		$term_menny = $sor['term_menny'];
		$ar = $sor['ar'];
		$term_szin = $sor['term_szin'];
		$term_meret = $sor['term_meret'];
		$osszeg = sprintf("%.02f", $ar*$term_menny);
		$kimenet .="
		<tr>
			<td align=\"center\">$nev</td>
			<td>$term_meret</td>
			<td>$term_szin</td>
			<td>$ar Ft</td>
			<td>$term_menny</td>
			<td>$osszeg</td>
			<td><a href=\"kocsibol_kivesz.php?kosar_azon=$kosar_azon\">Törlés</a></td>
		</tr>";
	}
		$kimenet .="</table>";
}

?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Bevásárlókocsi!</title>
</head>
<body>
	<?php echo $kimenet; ?>
</body>