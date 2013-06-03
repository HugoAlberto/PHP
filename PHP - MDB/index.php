<!DOCTYPE html>
<?
//Ouverture de mysql
$connect=mysql_connect('localhost','root','root');
if ($connect === false) {
  die('ERROR: Cannot initialize mysql handle');  
}
//Ouverture de la base de données
$db=mysql_select_db('gsbapp');
if ($db === false) {
  die('ERROR: Cannot initialize database handle');  
}
<?
//Si le bouton est utilisé
if(isset($_POST['action']) && ($_POST['action']=="Deconnexion"))
{
	//Fermeture de la session
	session_destroy();
	header('Location: ');
}//Fin du if isset
//Si je me connecte
if(isset($_POST['action']) && ($_POST['action']=="Connexion"))
{
	$login=$_POST["inputLogin"];
	$mdp=$_POST["inputMdp"];
	$sql="SELECT PRA_LOGIN, PRA_MDP FROM PRATICIEN";
	$result=mysql_query($sql);
	if()
	{		
		$_SESSION['login']=$login;
		$_SESSION['mdp']=$mdp;
	}
	else
	{
		echo("Erreur lors de la connexion");
	}
?>
	
<?
}//Fin du if isset
?>
<html>
<head>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" href="NEW.css"/>
	<title>Page d'avis de medicaments</title>
</head>
<body>
	<h1>Connexion</h1>
<?
//Si je suis déjà connecté
if(isset($_SESSION['login']) && isset($_SESSION['mdp']) && isset($_SESSION['base']))
{

}//Fin du if isset
//Si je ne suis pas connecté
if(empty($_SESSION['login']) && empty($_SESSION['mdp']) && empty($_SESSION['base']))
{
?>
<h2>Connexion</h2>
<table>
	<tr>
		<form name="AjoutTable" method="post" action="">
		Login :<input type="text" name="inputLogin" size="15"/>
		Mot de passe :<input type="password" name="inputMdp" size="15"/>
		<input type="submit" name="action" value="Connexion"/>
		</form>
	</tr>
</table>
<?
}//Fin du if empty
?>
</body>
</html>
