<?
function trouverFichier($nom,$emplacement){
	include("co.php");
	//echo("$emplacement/$nom");
	$fichier=fopen("$emplacement/$nom","r");
	while($row=fgets($fichier)){
		$position1=strpos($row,"function");
		$reste=substr($row, $position1-8);
		$position2=strpos($reste,"(");
		$fin=substr($reste,0,$position2);
		$sql="INSERT INTO Fonction (fonNom) VALUES($fin);";
	}
}
if(isset($_POST['actionAjout'])&&($_POST['actionAjout']=="Enregistrer")){
	include("co.php");
	//Récup des infos.
	$nomF=$_POST["fonNom"];
	$nom=$_POST["inputNom"];
	$emplacement=$_POST["inputEmplacement"];
	//Requete qui cherche si la fonction entrée existe dans la base.
	$sqlNomFonction="SELECT fonNum, fonNom FROM Fonction WHERE fonNom='".$nomF."';";
	$resultNomFonction=mysql_query($sqlNomFonction) or die(mysql_error());
	while($row = mysql_fetch_array($resultNomFonction)){
		if($row["fonNom"]==$nom){
			$sql="INSERT INTO Script
			VALUES(NULL,'$nom','$emplacement',".$row["fonNom"].");";
			echo $sql;
			$resultat=mysql_query($sql) or die(mysql_error());
			//header('Location: script.php');
		}
	}
	trouverFichier($nom,$emplacement);
}
if(isset($_POST['actionModification']) && ($_POST['actionModification']=="Modifier")){
	include("co.php");
	//Récup des infos.
	$numScript=$_POST["inputNumScript"];
	$nom=$_POST["inputNom"];
	$emplacement=$_POST["inputEmplacement"];
	$sql="UPDATE Script SET scrNom='$nom',scrEmplacement='$emplacement' where scrNum='$numScript'";
	$result=mysql_query($sql);
	//echo $sql;
	header('Location: script.php');
}
if(isset($_POST['actionSupprimer']) && ($_POST['actionSupprimer']=="Supprimer"))
{
	include ("co.php");
	$numScript=$_POST["scriptSup"];
	$sql="DELETE FROM Script WHERE scrNum=".$numScript.";";
	$resultat=mysql_query($sql);
	header('Location: script.php');
}
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8"/>
<link rel="stylesheet" href="site.css"/>

	<head>
		<title>Gestion des scripts</title>

	</head>
	<div class="accueil"><p><a href="index.php"/>Acceuil</a></p></div>
	<center><h1>Gestion des scripts</h1></center>
	<body>
		<div class="tab">
		<p><h2>Scritps présents dans la base de données: </h2></p>
			<table>
				<thead>
					<tr>
						<th>Num script</th>
						<th>Nom</th>
						<th>Emplacement</th>
						<th>Nom de la fonction</th>
					</tr>
				</thead>
				<tbody>
				<?php
					include ("co.php");
					$sql="select Script.*, fonNom from Script natural join Fonction";
					$result=mysql_query($sql);
					while($array=mysql_fetch_array($result))
					{
						$nomF=$array['fonNom'];
						$nom=$array['scrNom'];
						$emplacement=$array['scrEmplacement'];
						$num=$array['scrNum'];
					?>
					<tr>
						<th><?=$num?></th>
						<th><?=$nom?></th>
						<th><?=$emplacement?></th>
						<th><?=$nomF?></th>
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
				$sql="select Script.* from Script";
				$result=mysql_query($sql);
				while($array=mysql_fetch_array($result))
				{
					$num=$array['scrNum'];
					$nom=$array['scrNom'];
					$emplacement=$array['scrEmplacement'];
			?><tr>
			<form name="modif" method="post" action="">
				<th>Nom script :<input type="text" name="inputNom" value="<?=$nom?>" size="15"/></th>
				<th>Emplacement :<input type="text" name="inputEmplacement" value="<?=$emplacement?>" size="20"/></th>
				<input type="hidden" name="inputNumScript" value="<?=$num?>"/>
				<th><input type="submit" name="actionModification" value="Modifier"/></th>
			</form>
                        <form name="fSuppression" method="POST" action="">
                                <input type="hidden" name="scriptSup" value="<?=$num?>"/>
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
					<th>Nom script :<input type="text" name="inputNom" size="15"/></th>
					<th>Emplacement :<input type="text" name="inputEmplacement" size="20"/></th>
					<th><select name="fonNom">
						<? 
							include("co.php");
							$result= mysql_query("SELECT fonNum, fonNom FROM Fonction");
							while($row = mysql_fetch_assoc($result)){
							echo ('<option value="'.$row['fonNum'].'">'.$row['fonNom'].'</option>');
							}
						?>
					</select></th>
					<th><input type="submit" name="actionAjout" value="Enregistrer"/></th>
				</form>	
			</table>
		</div>
	</body>
</html>
