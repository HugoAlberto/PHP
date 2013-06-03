<?php
	include ("co.php");
	//Récup des infos.
	$nom=$_POST["inputCouleur"];
	$red=$_POST["inputRed"];
	$green=$_POST["inputGreen"];
	$blue=$_POST["inputBlue"];
	$sql="insert into couleur
	values('$nom', '$red', '$green', '$blue');";
	$resultat=mysql_query($sql);
	header('Location: formAjout.php');
?>
