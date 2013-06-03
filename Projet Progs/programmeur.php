<?
//PHP en tête de fichier car 'header('Location --/php')' ne fonctionne pas si du html est au dessus de lui. 
if(isset($_POST['actionAjout']) && ($_POST['actionAjout']=="Enregistrer"))
{
	include ("co.php");
	//Récup des infos.
	$nom=$_POST["inputNom"];
	$prenom=$_POST["inputPrenom"];
	$sql="INSERT INTO Programmeur
	VALUES(NULL, '$nom', '$prenom');";
	$resultat=mysql_query($sql);
	header('Location: programmeur.php');
}
if(isset($_POST['actionModification']) && ($_POST['actionModification']=="Modifier"))
{
	include ("co.php");
	//Récup des infos.
	$numProgrammeur=$_POST["inputNum"];
	$nom=$_POST["inputNom"];
	$prenom=$_POST["inputPrenom"];
	$sql="UPDATE Programmeur SET proNom='$nom',proPrenom='$prenom' where proNum='$numProgrammeur'";
	$result=mysql_query($sql);
	header('Location: programmeur.php');
}
if(isset($_POST['actionSupprimer']) && ($_POST['actionSupprimer']=="Supprimer"))
{
	include ("co.php");
	$numProgrammeur=$_POST["nomSup"];
	$sql="DELETE FROM Programmeur WHERE proNum='$numProgrammeur'";
	$resultat=mysql_query($sql);
	header('Location: programmeur.php');
}
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8"/>
<link rel="stylesheet" href="site.css"/>

	<head>
		<title>Gestion des programmeurs</title>
	</head>
	<div class="accueil"><p><a href="index.php"/>Acceuil</a></p></div>
	<center><h1>Gestion des programmeurs</h1></center>
	<body>
		<div class="tab">
		<p><h2>Programmeurs présents dans la base de données: </h2></p>
			<table>
				<thead>
					<tr>	
						<th>Id programmeur</th>
						<th>Nom programmeur</th>
						<th>Prénom programmeur</th>
					</tr>
				</thead>
				<tbody>
				<?php
					include ("co.php");
					$sql="select * from Programmeur";
					$result=mysql_query($sql);
					while($array=mysql_fetch_array($result))
					{
						$num=$array['proNum'];
						$nom=$array['proNom'];
						$prenom=$array['proPrenom'];
					?>
					<tr>
						<th><?=$num?></th>
						<th><?=$nom?></th>
						<th><?=$prenom?></th>
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
				$sql="select * from Programmeur";
				$result=mysql_query($sql);
				while($array=mysql_fetch_array($result))
				{ 
						$num=$array['proNum'];
						$nom=$array['proNom'];
						$prenom=$array['proPrenom'];
			?><tr>
			<form name="modifP" method="post" action="">
				<th>Nom :<input type="text" name="inputNom" value="<?=$nom?>"/></th>
				<th>Prénom :<input type="text" name="inputPrenom" value="<?=$prenom?>"/></th>
				<input type="hidden" name="inputNum" value="<?=$num?>"/>
				<th><input type="submit" name="actionModification" value="Modifier"/></th>
			</form>
                        <form name="suppP" method="POST" action="">
                                <input type="hidden" name="nomSup" value="<?=$num?>"/>
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
			<form name="ajoutP" method="POST" action="">
				<th>Nom: <input type="text" name="inputNom" size="15"/></th>
				<th>Prénom: <input type="text" name="inputPrenom" size="15"/></th>
				<th><input type="submit" name="actionAjout"value="Enregistrer"/></th>
			</form>	
			</table>
		</div>
	</body>
</html>
