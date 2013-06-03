<!DOCTYPE html>
<?
//Ouverture de la base de données
$mdb=mdb_open('/var/www/gsb/Swiss_Visite.mdb');
if ($mdb === false) {
  die('ERROR: Cannot initialize database handle');  
}
?>
<html>
<head>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" href="NEW.css"/>
	<title>Page d'affichage des visiteurs</title>
</head>
<body>
	<h1>Tableau des visiteurs</h1>
	<table border="0">
	 <tr>
  	  <th>Numéro</th>
	  <th>Nom</th>	
	  <th>Prenom</th>
	  <th>Adresse</th>
	  <th>Code postal</th>
	  <th>Ville</th>
	  <th>Date d'embauche</th>
	  <th>Code Secteur</th>
	  <th>Code Laboratoire</th>
	  <th>Code Département</th>
	 </tr>
	<?
	$tbl = mdb_table_open($mdb, 'MEDICAMENT') or die('ERROR: Cannot open table ');
	while ($row = mdb_fetch_row($tbl)) {
	  echo "<tr>\n";
	  foreach ($row as $v) {
	    echo "<td>$v</td>\n";  
	  }
	  echo "</tr>\n";
	}
	mdb_table_close($tbl);
	mdb_close($mdb);		
	?>
	</table>
</body>
</html>
