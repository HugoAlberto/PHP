<!DOCTYPE html>
<html>
<meta charset="UTF-8"/>
<link rel="stylesheet" href="site.css"/>

	<head>
		<title>Gestion des informations</title>
	</head>
	<div class="haut">
	<center><h1>Gestion des informations</h1></center>
	<body>
			<a href="programmeur.php"/>Gestion des programmeurs</a>
			<a href="fonction.php"/>Gestion des fonctions</a>
			<a href="script.php"/>Gestion des scripts</a>
	</div>
		<div class="bas">
		<p><h1>Recherche rapide: </h1></p>
		<table>
			<tr>
				<form name="modif" method="post" action="">
				Nom fonction :<input type="text" name="inputNom" value="NULL"  size="15"/>
				Nom script :<input type="text" name="inputScript" value="NULL" size="15"/>
				Rôle :  <select name="role">
					<option selected="selected">Selectionner un rôle</option>
<? 	
					include("co.php");
					$result= mysql_query("SELECT fonNum, fonRole FROM Fonction GROUP BY fonRole");
					while($row = mysql_fetch_assoc($result)){
					echo ('<option value="'.$row['fonRole'].'">'.$row['fonRole'].'</option>');
					}
?>
				</select>
				<input type="submit" name="actionRecherche" value="Rechercher"/>
				</form>
			</tr>
		</table>
		</div>
<?
if(isset($_POST['actionRecherche']) && ($_POST['actionRecherche']=="Rechercher"))
{
	include ("co.php");
	//Récup des infos.
	$nom=$_POST["inputNom"];
	$role=$_POST["role"];
	$script=$_POST["inputScript"];
	$sql="SELECT fonNom, fonRole, scrNom 
		FROM Fonction NATURAL JOIN Programmeur NATURAL JOIN Script 
		WHERE fonNom like '%$nom%'
		OR fonRole='$role'
		OR scrNom like '%$script%';";
	$result=mysql_query($sql);
	//echo $sql;
	$nb=0;
	while($array=mysql_fetch_array($result))
	{
		$nom=$array['fonNom'];
		$script=$array['scrNom'];
		$role=$array['fonRole'];
?>
		<div class="result">
			</br>
			Résultat n°<?=++$nb?>
			<p><strong>Nom de la fonction : </strong><?=$nom?></p>
			<p><strong>Nom du script : </strong><?=$script?></p>
			<p><strong>Rôle : </strong><?=$role?></p>
			</br>		
		</div>
<?
	}
}
?>

		</div>
	</body>
</html>
