<!DOCTYPE html>
<html>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" href="site.css"/>
	<head>
		<title>Recherche</title>
	</head>
	<div class="accueil"><p><a href="index.php"/>Acceuil</a></p></div>
	<center><h1>Recherche</h1></center>
	<body>
		<div><p><h2>Formulaire de recherche: </h2></p></div>
		<table>
			<tr>
				<form name="modif" method="post" action="">
				Nom fonction :<input type="text" name="inputNom" value="" size="15"/>
				Rôle :  <select name="role">
					<option selected="selected">Selectionner un rôle</option>
<? 	
					include("co.php");
					$result= mysql_query("SELECT fonRole FROM Fonction");
					while($row = mysql_fetch_assoc($result)){
					echo ('<option value="'.$row['fonRole'].'">'.$row['fonRole'].'</option>');
					}
?>
				</select>
				<p>Nom du script :<input type="text" name="inputScript" value="" size="10"/></p>
				<input type="hidden" name="inputNomFonction" value="<?=$num?>"/>
				<p><input type="submit" name="actionRecherche" value="Rechercher"/></p>
				</form>
			</tr>
		</table>
		</div>
	</div>
	<p><h2>Résultat de la recherche: </h2></p>
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
		WHERE fonNom='$nom'
		OR fonRole='$role'
		OR scrNom='$script';";
	$result=mysql_query($sql);
	//echo $sql;
	while($array=mysql_fetch_array($result))
	{
		$nom=$array['fonNom'];
		$script=$array['scrNom'];
		$role=$array['fonRole'];
//if(isset ($nom))
//{
?>
	<table>
		<thead>
			<tr>
				<th>Nom fonction</th>
				<th>Rôle fonction</th>
				<th>Nom script</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th><?=$nom?></th>
				<th><?=$script?></th>
				<th><?=$role?></th>
			</tr>
<?
//}
//else{
//echo("Error");
//}
	}
?>
		</tbody>
	</table></br>
<?
}
?>
	</body>
</html>
