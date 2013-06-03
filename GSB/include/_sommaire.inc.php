<?php
/*
 * Contient la division pour le sommaire, sujet à des variations suivant la 
 * connexion ou non d'un utilisateur, et dans l'avenir, suivant le type de cet utilisateur 
 */
?>
    <!-- Division pour le sommaire -->
    <div id="menuGauche">
    <div id="infosUtil">
<?   
    if(estVisiteurConnecte())//Si la personne est connecté
	{
    	$idUser = obtenirIdUserConnecte() ;
        $lgUser = obtenirDetailVisiteur($idConnexion, $idUser);
        $nom = $lgUser['nom'];
        $prenom = $lgUser['prenom'];
		$type = $lgUser['type'];
?>
	<h2>
<?  
    	echo $nom . " " . $prenom ;
?>
	</h2>       
<?
	}//Fin du if est connecté
?>  
      </div>
<?
	if(estVisiteurConnecte())//Si la personne est connecté
	{
		if($type==1)//Si c'est un visiteur
		{
?>
		<link href="./styles/stylesVisiteur.css" rel="stylesheet" type="text/css" />
		<h3>Visiteur médical</h3> 
        <ul id="menuList">
           <li class="smenu">
              <a href="cAccueil.php">Accueil</a>
           </li>
           <li class="smenu">
              <a href="cSeDeconnecter.php">Se déconnecter</a>
           </li>
           <li class="smenu">
              <p>Fiches de frais:</p>
           </li>
           <li class="smenu">
              <a href="cSaisieFicheFrais.php">Saisie fiche de frais</a>
           </li>
           <li class="smenu">
              <a href="cConsultFichesFrais.php">Mes fiches de frais</a>
           </li>
         </ul>
<?
		}//Fin du if c'est un visiteur
		if($type==2)//Si un comptable
		{
?>
		<link href="./styles/stylesComptable.css" rel="stylesheet" type="text/css" />
		<h3>Comptable</h3> 
        <ul id="menuList">
           <li class="smenu">
              <a href="cAccueil.php">Accueil</a>
           </li>
           <li class="smenu">
              <a href="cSeDeconnecter.php">Se déconnecter</a>
           </li>
           <li class="smenu">
              <p>Fiches de frais:</p>
           </li>
           <li class="smenu">
              <a href="cSuiviPaiement.php">Suivre le paiement fiche de frais</a>
           </li>
          <li class="smenu">
              <a href="cValidFrais.php">Valider fiche de frais</a>
           </li>
         </ul>
<?	
		}//Fin du si c'est un comptable
        if ( nbErreurs($tabErreurs)>0)//Affichage des éventuelles erreurs déjà détectées
		{
            echo toStringErreurs($tabErreurs) ;
        }//Fin du if de verification
	}//Fin du if est connecté
?>
    </div>
    
