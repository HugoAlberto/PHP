<!DOCTYPE html>
<html>
<meta charset="UTF-8"/>
<link rel="stylesheet" href="site.css"/>
	<head>

	</head>
	<center><h1><a href="formAjout.php"/>Ajout de couleurs</a></h1></center>
	<body>
		<div>
		<p><h2>Couleurs déjà existantes dans la table:</h2></p>
			<table>
				<thead>
					<tr>
						<th>Nom</th>
						<th>Rouge</th>
						<th>Vert</th>
						<th>Bleu</th>
					</tr>
				</thead>
				<tbody>
				<?php
					include ("co.php");
					$sql="select * from couleur";
					$result=mysql_query($sql);
					while($array=mysql_fetch_array($result))
					{
						$nomCouleur=$array['nomCouleur'];
						$redCouleur=$array['redCouleur'];
						$greenCouleur=$array['greenCouleur'];
						$blueCouleur=$array['blueCouleur'];
					?>
					<tr>
						<th><?=$nomCouleur?></th>
						<th><?=$redCouleur?></th>
						<th><?=$greenCouleur?></th>
						<th><?=$blueCouleur?></th>
					</tr>
				<?
					}
				?>
				</tbody>
			</table>
			<p><h2>Formulaire de modification: </h2></p>
			<div>
			<table>
			<? 
				$sql="select * from couleur";
				$result=mysql_query($sql);
				while($array=mysql_fetch_array($result))
				{ 
					$nomCouleur=$array['nomCouleur'];
					$redCouleur=$array['redCouleur'];
					$greenCouleur=$array['greenCouleur'];
					$blueCouleur=$array['blueCouleur'];
			?><tr>
			<form name="modif" method="post" action="modif.php">
				<th>Nom :<input type="text" name="inputCouleur" value="<?=$nomCouleur?>" size="10"/></th>
				<th>Red :<input type="text" name="inputRed" value="<?=$redCouleur?>" size="3"/></th>
				<th>Green :<input type="text" name="inputGreen" value="<?=$greenCouleur?>" size="3"/></th>
				<th>Blue :<input type="text" name="inputBlue" value="<?=$blueCouleur?>" size="3"/></th>
				<input type="hidden" name="inputNomCouleur" value="<?=$nomCouleur?>"/>
				<th><input type="submit" name="valider" value="valider"/></th>
			</form>
                        <form name="fSuppression" method="POST" action="supp.php">
                                <input type="hidden" name="couleurSup" value="<?=$nomCouleur?>"/>
                                <th><input type="submit" value="Supprimer"/></th>
                        </form>
			</tr>
			<? 	} ?>
			</table>
			</div>
		</div>
		<div>
			<p><h2>Formulaire de saisie: </h2></p>
			<table>
			<form name="fAjout" method="POST" action="ajout.php">
				<th>Nom: <input type="text" name="inputCouleur" size="10"/></th>
				<th>Red: <input type="text" name="inputRed" size="3" maxlength="3"/></th>
				<th>Green: <input type="text" name="inputGreen" size="3" maxlength="3"/></th>
				<th>Blue: <input type="text" name="inputBlue" size="3" maxlength="3"/></th>
				<th><input type="submit" value="Enregistrer"/></th>
			</form>	
			</table>
		</div>
	</body>
</html>
