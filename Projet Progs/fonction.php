<?
//PHP en tête de fichier car 'header('Location --/php')' ne fonctionne pas si du html est au dessus de lui. 
if(isset($_POST['actionAjout']) && ($_POST['actionAjout']=="Enregistrer"))
{
	include ("co.php");
	//Récup des infos.
	$nom=$_POST["inputNom"];
	$date=$_POST["inputDate"];
	$statut=$_POST["inputStatut"];
	$role=$_POST["inputRole"];
	$num=$_POST["proNum"];
	//Ajoute la valeur dans la table en fonction de l'id du programmeur.
	$sql="INSERT INTO Fonction
	VALUES(NULL,'$nom','$date','$statut','$role','$num');";
	//echo $sql;
	$resultat=mysql_query($sql) or die(mysql_error());
	header('Location: fonction.php');
}
if(isset($_POST['actionModification']) && ($_POST['actionModification']=="Modifier"))
{
	include ("co.php");
	//Récup des infos.
	$numFonction=$_POST["inputNomFonction"];
	$nom=$_POST["inputNom"];
	$date=$_POST["inputCreation"];
	$statut=$_POST["inputStatut"];
	$role=$_POST["inputRole"];
	$sql="update Fonction set fonNom='$nom',fonDate='$date',fonStatut='$statut',fonRole='$role' where fonNum='$numFonction'";
	$result=mysql_query($sql) or die(mysql_error());
	//echo $sql;
	header('Location: fonction.php');
}
if(isset($_POST['actionSupprimer']) && ($_POST['actionSupprimer']=="Supprimer"))
{
	include ("co.php");
	$numFonction=$_POST["fonctionSup"];
	$sql="DELETE FROM Fonction WHERE fonNum='$numFonction'";
	$resultat=mysql_query($sql);
	header('Location: fonction.php');
}
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8"/>
<link rel="stylesheet" href="site.css"/>

	<head>
		<title>Gestion des fonctions</title>

	</head>
	<div class="accueil"><p><a href="index.php"/>Acceuil</a></p></div>
	<center><h1>Gestion des fonctions</h1></center>
	<body>
		<div class="tab">
		<p><h2>Fonctions présentes dans la base de données: </h2></p>
			<table>
				<thead>
					<tr>
						<th>Num fonction</th>
						<th>Nom</th>
						<th>Date de création</th>
						<th>Status</th>
						<th>Rôle</th>
						<th>Programmeur</th>
					</tr>
				</thead>
				<tbody>
				<?php
					include ("co.php");
					$sql="SELECT Fonction.*,proNom, proPrenom FROM Fonction NATURAL JOIN Programmeur ORDER BY Fonction.fonNum";
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
						<th><?=$statut?></th>
						<th><?=$role?></th>
						<th><? echo $programmeur ." ". $programmeurP?></th>
					</tr>
				<?
					}
				?>
				</tbody>
			</table>
			</div>
			<p><h2>Formulaire de modification: </h2></p>
			<div class="tab">
			<table>
			<? 
				$sql="SELECT Fonction.*,proNom FROM Fonction NATURAL JOIN Programmeur ORDER BY Fonction.fonNum";
				$result=mysql_query($sql);
				while($array=mysql_fetch_array($result))
				{ 
					$num=$array['fonNum'];
					$nom=$array['fonNom'];
					$date=$array['fonDate'];
					$statut=$array['fonStatut'];
					$role=$array['fonRole'];
					$programmeur=$array['proNom'];
			?><tr>
			<form name="modif" method="post" action="">
				<th>Nom fonction :<input type="text" name="inputNom" value="<?=$nom?>" size="15"/></th>
				<th>Date Création :<input type="text" name="inputCreation" value="<?=$date?>" size="10"/></th>
				<th>Statut :<input type="text" name="inputStatut" value="<?=$statut?>" size="20"/></th>
				<th>Rôle :<input type="text" name="inputRole" value="<?=$role?>" size="20"/></th>
				<input type="hidden" name="inputNomFonction" value="<?=$num?>"/>
				<th><input type="submit" name="actionModification" value="Modifier"/></th>
			</form>
                        <form name="fSuppression" method="POST" action="">
                                <input type="hidden" name="fonctionSup" value="<?=$num?>"/>
                                <th><input type="submit" name="actionSupprimer" value="Supprimer"/></th>
                        </form>
			</tr>
			<? 	} ?>
			</table>
			</div>
		</div>
		<div class="tab">
			<p><h2>Formulaire de saisie: </h2></p>
			<table>
			<form name="fAjoutFonction" method="POST" action="">
				<th>Nom fonction: <input type="text" name="inputNom" size="15"/></th>
				<th>Date: <input type="text" name="inputDate" size="10"/></th>
				<th>Statut: <input type="text" name="inputStatut" size="20"/></th>
				<th>Role: <input type="text" name="inputRole" size="20"/></th>
				<th>
				<select name="proNum">
					<? 	
						$result= mysql_query("SELECT proNum, proNom, proPrenom FROM Programmeur");
						while($row = mysql_fetch_assoc($result)){
						echo ('<option value="'.$row['proNum'].'">'.$row['proNom'].' '.$row['proPrenom'].'</option>');
						}
					?>
				</select>
				</th>
				<th><input type="submit" name="actionAjout" value="Enregistrer"/></th>
			</form>	
			</table>
		</div>
	</body>
</html>
