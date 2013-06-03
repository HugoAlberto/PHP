<?php
	include ("co.php");
	$nomCouleur1=$_POST["couleurSup"];
	$sql="DELETE from couleur where nomCouleur='$nomCouleur1'";
	$resultat=mysql_query($sql);
	header('Location: formAjout.php');
?>
