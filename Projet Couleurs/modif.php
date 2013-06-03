<?php
	include ("co.php");
	//Récup des infos.
	$nomCouleur=$_POST["inputNomCouleur"];
	$nom=$_POST["inputCouleur"];
	$red=$_POST["inputRed"];
	$green=$_POST["inputGreen"];
	$blue=$_POST["inputBlue"];;
	$sql="update couleur set nomCouleur='$nom',redCouleur=$red,greenCouleur=$green,blueCouleur=$blue where nomCouleur='$nomCouleur'";
	$result=mysql_query($sql);
	header('Location: formAjout.php');
?>
