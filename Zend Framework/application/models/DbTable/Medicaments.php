<?php
class Application_Model_DbTable_Medicaments extends Zend_Db_Table_Abstract
{
    protected $_name = 'MEDICAMENT';

    public function obtenirMedicaments($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('MED_DEPOTLEGAL = ' . $id);
        if (!$row) {
            throw new Exception("Impossible de trouver l'enregistrement $id");
        }
        return $row->toArray();
    }

    public function ajouterMedicaments($nom, $codeFamille, $composition, $effets, $contreIndic, $prix)
    {
        $data = array(
            'MED_NOMCOMMERCIAL' => $nom,
	    'FAM_CODE'		=> $codeFamille,
	    'MED_COMPOSITION'	=> $composition,
	    'MED_EFFETS'	=> $effets,
	    'MED_CONTREINDIC'	=> $contreIndic,
	    'MED_PRIXECHANTILLON' => $prix,
        );
        $this->insert($data);
    }

    public function modifierMedicaments($id, $nom, $codeFamille, $composition, $effets, $contreIndic, $prix)
    {
        $data = array(
            'MED_NOMCOMMERCIAL' => $nom,
	    'FAM_CODE'		=> $codeFamille,
	    'MED_COMPOSITION'	=> $composition,
	    'MED_EFFETS'	=> $effets,
	    'MED_CONTREINDIC'	=> $contreIndic,
	    'MED_PRIXECHANTILLON' => $prix,
        );
        $this->update($data, 'MED_DEPOTLEGAL = '. (int)$id);
    }

    public function supprimerMedicaments($id)
    {
        $this->delete('MED_DEPOTLEGAL =' . (int)$id);
    }
}
