<?php
/*--------------------------------------------------------------------------------------------------------------*\
**                    Modification de formValidFrais.php effectué par Boulouk Hugo, Le: 2013/03                 **
\*--------------------------------------------------------------------------------------------------------------*/
$repInclude = './include/';
require($repInclude . "_init.inc.php");
if(!estVisiteurConnecte())//Si le visiteur n'est pas connecté
{
   header("Location: cSeConnecter.php");  
}//Fin du si le visiteur n'est pas connecté
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");
?>
<!-- Résolution lors d'un problème de charset sur cette page -->
<meta charset="utf-8"/>
<!-- Mise en page du contenu dans le centre de notre page pour respecter dans le css -->
<div id="contenu">
<?php
$etape=lireDonnee("etape","demanderSaisie");
$tabQteEltsForfait=lireDonneePost("txtEltsForfait", "");
$idLigneHF = lireDonnee("idLigneHF", "");
// structure de décision sur les différentes étapes du cas d'utilisation
if ($etape == "validerSaisie")
{
    $ok = verifierEntiersPositifs($tabQteEltsForfait);      
    if(!$ok)
    {
       ajouterErreur($tabErreurs, "Chaque quantité doit être renseignée et numérique positive.");
    }//Fin du else
    else 
    { // mise à jour des quantités des éléments forfaitisés
	$idVisiteur=$_SESSION['idVisiteur'];
	$idMois=$_SESSION['idMois'];
        modifierEltsForfait($idConnexion, $idMois, $idVisiteur, $tabQteEltsForfait);
    }//Fin du else
}//Fin du if
elseif ($etape == "validerSuppressionLigneHF") 
{
	$idVisiteur=$_SESSION['idVisiteur'];
	modifierLigneHF($idConnexion, $idLigneHF, $idVisiteur);
}//Fin du else if
if(isset($_POST['valider']) && ($_POST['valider']=="Valider la fiche de frais"))
{
	$idVisiteur=$_SESSION['idVisiteur'];
	$idMois=$_SESSION['idMois'];
	$req="UPDATE FicheFrais SET idEtat='VA' WHERE idVisiteur='".$idVisiteur."' AND mois='".$idMois."';";
	$result=mysql_query($req);
}
/*--------------------------------------------------------------------------------------------------------------*\
**                              Formulaire pour savoir quel visiteur et quel mois                               **
\*--------------------------------------------------------------------------------------------------------------*/
$sessionOk=false;
if(isset($_SESSION['idVisiteur']) && isset($_SESSION['idMois']))
{
	$idVisiteur=$_SESSION['idVisiteur'];
	$idMois=$_SESSION['idMois'];
	$sessionOk=true;
}//Fin du if
?>
	<!-- Formulaire pour selectionner le nom d'un visiteur et le mois dans lequel on veut voir ses fiches -->
	<form name="formNomMois" method="POST" action = "">
		<h2> Validation des frais par visiteur </h2>
		<label class="titre">Choisir un visiteur :</label>
        <!-- Liste déroulante de sélection des visiteurs -->
        <select name="lstVisiteur" class="zone">
		<?php
		$sql="SELECT id, nom, prenom FROM Visiteur";
		$result=mysql_query($sql);
		while($row=mysql_fetch_array($result))
		{
			?>
          		<!-- Affichage du nom puis du prénom avec comme value caché l'id du visiteur -->
			<?
      			if($sessionOk=false)
			{
			?>
            			<option value="<?=$idVisiteur?>">
			<?
			}//Fin du if
			else
			{
			?>
        			<option value="<?=$row['id']?>"> 
			<?			
			}//Fin du else
            		echo $row['nom']." ".$row['prenom']; ?></option>
            		<?
		}//Fin du while
			?>
		</select>
    		<!-- Liste déroulante de sélection des mois en fonction du visiteur sélectionné précédement -->
		<label>Choisir un mois : </label>
		<select name="lstMois" class="zone">
		<?php
		$sql2="SELECT DISTINCT FicheFrais.mois as mois FROM FicheFrais ORDER BY FicheFrais.mois desc";
		$result2=mysql_query($sql2);
		while($row2=mysql_fetch_array($result2))
		{
		?>
          	<!-- Affichage du mois en lettre suivi de l'année avec en value caché l'id du mois -->
        	<?
           		if($sessionOk=false)
			{
			?>
        		    	<option value="<?=$idMois?>">
			<?
			}//Fin du if
			else
			{			
			?>
        		    	<option value="<?=$row2['mois']?>">
			<?
			}//Fin du else
			echo obtenirLibelleMois(intval(substr($row2['mois'],4,2))) . " " . substr($row2['mois'],0,4); ?></option>
          		<?
			}//Fin du while
			?>
   	        </select>
   		<input class="zone" name="action" value="Afficher" type="submit"/>
	</form>
<?php
/*--------------------------------------------------------------------------------------------------------------*\
**                           Affichage des données en fonction du visiteur et du mois                           **
\*--------------------------------------------------------------------------------------------------------------*/
if(isset($_POST['action']) && ($_POST['action']=="Afficher"))
{
	$_SESSION['idVisiteur']=$_POST['lstVisiteur'];
	$_SESSION['idMois']=$_POST['lstMois'];
}//Fin du if
if(isset($_SESSION['idVisiteur']) && isset($_SESSION['idMois']))
{
	$idVisiteur=$_SESSION['idVisiteur'];
	$idMois=$_SESSION['idMois'];
	$req="SELECT count(*) AS nb FROM FicheFrais WHERE idVisiteur='".$idVisiteur."' AND mois='".$idMois."' AND idEtat='CL';";
	$result=mysql_query($req);
	$row=mysql_fetch_array($result);
	if($row['nb']==0)
	{
	?>
		<div class="corpsForm"><p style="text-align:center;">Pas de fiche de frais pour ce visiteur ce mois.</p></div></div>
	<?	
	}
	else
	{
	?>
	<h2>Frais au forfait </h2>
<?php
  if ($etape == "validerSaisie") {
      if (nbErreurs($tabErreurs) > 0) {
          echo toStringErreurs($tabErreurs);
      } 
      else {
?>
      <p class="info">Les modifications de la fiche de frais ont bien été enregistrées</p>        
<?php
      }   
  }
?>  
<form action="" method="post">
    <div class="corpsForm">
        <input type="hidden" name="etape" value="validerSaisie" />
	<?php          
        // demande de la requête pour obtenir la liste des éléments 
        // forfaitisés du visiteur connecté pour le mois demandé
        $req = obtenirReqEltsForfaitFicheFrais($idMois, $idVisiteur);
        $idJeuEltsFraisForfait = mysql_query($req, $idConnexion);
        echo mysql_error($idConnexion);
        $lgEltForfait = mysql_fetch_assoc($idJeuEltsFraisForfait);
        while (is_array($lgEltForfait) ) 
	{
            $idFraisForfait = $lgEltForfait["idFraisForfait"];
            $libelle = $lgEltForfait["libelle"];
            $quantite = $lgEltForfait["quantite"];
            ?>
            <p>
              <label for="<?=$idFraisForfait?>"><?=$libelle?> : </label>
              <input type="text" id="<?=$idFraisForfait?>" 
                    name="txtEltsForfait[<?=$idFraisForfait?>]" 
                    size="10" maxlength="5"
                    title="Entrez la quantité de l'élément forfaitisé"
                    value="<?=$quantite?>" />
        </p>
        <?php        
           $lgEltForfait = mysql_fetch_assoc($idJeuEltsFraisForfait);   
        }//Fin du while
        mysql_free_result($idJeuEltsFraisForfait);
        ?>
  </div>  
  <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Mettre à jour" size="20" 
               title="Enregistrer les nouvelles valeurs des éléments forfaitisés" />
        <input id="annuler" type="reset" value="Annuler" size="20" />
      </p> 
  </div>  
</form>
        <!-- Tableau avec comme valeurs les données qui sont dans la base de données -->
  	<table class="listeLegere">
  	   <h2>Éléments hors forfait</h2>
             <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class="montant">Montant</th>  
                <th class="action">&nbsp;</th>              
             </tr>
<?php          
          // demande de la requête pour obtenir la liste des éléments hors
          // forfait du visiteur connecté pour le mois demandé
          $req = obtenirReqEltsHorsForfaitFicheFrais($idMois, $idVisiteur);
          $idJeuEltsHorsForfait = mysql_query($req, $idConnexion);
          $lgEltHorsForfait = mysql_fetch_assoc($idJeuEltsHorsForfait);
          // parcours des frais hors forfait du visiteur connecté
          while ( is_array($lgEltHorsForfait) ) {
          ?>
              <tr>
                <td><?php echo $lgEltHorsForfait["date"]; ?></td>
                <td><?php echo filtrerChainePourNavig($lgEltHorsForfait["libelle"]) ; ?></td>
                <td><?php echo $lgEltHorsForfait["montant"] ; ?></td>
                <td><a href="?etape=validerSuppressionLigneHF&amp;idLigneHF=<?php echo $lgEltHorsForfait["id"]; ?>"
                       onclick="return confirm('Voulez-vous vraiment refuser cette ligne de frais hors forfait ?');"
                       title="Refuser la ligne de frais hors forfait">Refuser</a></td>
              </tr>
          <?php
              $lgEltHorsForfait = mysql_fetch_assoc($idJeuEltsHorsForfait);
          }
          mysql_free_result($idJeuEltsHorsForfait);
?>
    </table>
		<?php
		$sql2="SELECT nbJustificatifs FROM FicheFrais WHERE idVisiteur=".$idVisiteur." AND mois=".$idMois.";";
		$result2=mysql_query($sql2);
		$row2=mysql_fetch_array($result2);
		$justificatifs=$row2['nbJustificatifs'];
		?>
		<p>Nombre de justificatifs :<?=$justificatifs?></p>
<form action="" method="post">
<div class="piedForm">
	<input name="valider" type="submit" value="Valider la fiche de frais" size="20"/>
</div>
</form>
</div>
<?php 
}//Fin du if
}//Fin du else
require($repInclude . "_pied.inc.html");
require($repInclude . "_fin.inc.php");
?>
