<?php
/** 
 * Page d'accueil de l'application web AppliFrais
 * @package default
 * @todo  RAS
 */
  $repInclude = './include/';
  require($repInclude . "_init.inc.php");
  if (!estVisiteurConnecte())//Si visiteur non connecté
  {
        header("Location: /gsb/cSeConnecter.php");  
  }//Fin du si visiteur non connecté
  require($repInclude . "_entete.inc.html");
  require($repInclude . "_sommaire.inc.php");
?>
  <!-- Division principale -->
  <div id="contenu">
      <h2>Bienvenue sur l'intranet GSB</h2>
  </div>
<?    
  require($repInclude . "_pied.inc.html");
  require($repInclude . "_fin.inc.php");
?>
