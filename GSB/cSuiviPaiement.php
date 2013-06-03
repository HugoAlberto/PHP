<?php
    $repInclude = './include/';
    require($repInclude . "_init.inc.php");
    if(!estVisiteurConnecte())//Si le visiteur n'est pas connecté
    {
        header("Location: cSeConnecter.php");  
    }//Fin du si le visiteur n'est pas connecté
    require($repInclude . "_entete.inc.html");
    require($repInclude . "_sommaire.inc.php");
	if(isset($_POST['formConsultFrais']) && ($_POST['formConsultFrais']=="envoyer"))//Si le formulaire est appellé
	{
		obtenirDetailFicheFrais($idCnx, $unMois, $unIdVisiteur);
	}//Fin de si le formulaire est appellé
?>
<meta charset="utf-8"/>
<div id="contenu">
<h2> Suivi des paiements </h2>
<?
$req="SELECT * FROM FicheFrais WHERE idEtat='VA';";
$result=mysql_query($req);
?>
<table border=1>
    <tr>
    <th style="color:white;">Identifiant visiteur</th>
    <th style="color:white;">Mois</th>
    <th style="color:white;">Nombre de justificatifs</th>
    <th style="color:white;">Montant valide</th>
    <th style="color:white;">Date de modification</th>
    <th style="color:white;">État</th>
    </tr>
    <?
    while($row=mysql_fetch_array($result))
    {
    ?>
    <tr>
    <td><?=$row['idVisiteur']?></td>
    <td><? echo obtenirLibelleMois(intval(substr($row['mois'],4,2))) ?> <? echo substr($row['mois'],0,4)?></td>
    <td><?=$row['nbJustificatifs']?></td>
    <td><?=$row['montantValide']?></td>
    <td><?=$row['dateModif']?></td>
    <td style="color:brown;"><?=$row['idEtat']?></td>
    </tr>
<?
    }
?>
</table>
</div>
<?php        
  require($repInclude . "_pied.inc.html");
  require($repInclude . "_fin.inc.php");
?>
