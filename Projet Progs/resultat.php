<!DOCTYPE html>
<html>
<meta charset="UTF-8"/>
<link rel="stylesheet" href="site.css"/>
	<head>
		<title>Recherche</title>
	</head>
	<body>
	<div class="accueil"><p><a href="index.php"/>Acceuil</a></p></div>
	<p><h2>Résultat de la recherche: </h2></p>
	<table>
		<thead>
			<tr>
				<th>Nom fonction</th>
				<th>Rôle fonction</th>
				<th>Nom script</th>
			</tr>
		</thead>
		<tbody>
		<?php
			include("co.php");
			$sql="select Fonction.*,proNom, proPrenom from Fonction natural join Programmeur";
			$result=mysql_query($sql);
			while($array=mysql_fetch_array($result))
				{
					$num=$array['fonNum'];
					$nom=$array['fonNom'];
					$date=$array['fonDate'];
					$statut=$array['fonStatut'];
					$role=$array['fonRole'];
					$programmeur=$array['proNom'];
					$programmeurP=$array['proPrenom'];
		?>
			<tr>
				<th><?=$num?></th>
				<th><?=$nom?></th>
				<th><?=$date?></th>
			</tr>
		<?
			}
		?>
		</tbody>
	</table></br>
	<button><a href="recherche.php"/>Effectuer une autre recherche</a></button>
	</body>
</html>
