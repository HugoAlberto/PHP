<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
	$Medicaments = new Application_Model_DbTable_Medicaments();
	$this->view->Medicaments = $Medicaments->fetchAll();
    }

    public function ajouterAction()
    {
      $form = new Application_Form_Medicaments();
      $form->envoyer->setLabel('Ajouter');
      $this->view->form = $form;

      if ($this->getRequest()->isPost()) {
          $formData = $this->getRequest()->getPost();
          if ($form->isValid($formData)) {
       	    $nomCommercial = $form->getValue('MED_NOMCOMMERCIAL');
            $famCode = $form->getValue('FAM_CODE');
            $composition = $form->getValue('MED_COMPOSITION');
            $effets = $form->getValue('MED_EFFETS');
            $contreindic = $form->getValue('MED_CONTREINDIC');
            $prix = $form->getValue('MED_PRIXECHANTILLON');
            $Medicaments = new Application_Model_DbTable_Medicaments();
            $Medicaments->ajouterMedicaments($nomCommercial, $famCode, $composition, $effets, $contreindic, $prix, $envoyer);
            $this->_helper->redirector('index');
          } 
	    else {
            $form->populate($formData);
            }
      }
    }

    public function modifierAction()
    {
    $form = new Application_Form_Medicaments();
    $form->envoyer->setLabel('Sauvegarder');
    $this->view->form = $form;

    if ($this->getRequest()->isPost()) {
        $formData = $this->getRequest()->getPost();
        if ($form->isValid($formData)) {
	    $id = $form->getValue('MED_DEPOTLEGAL');
       	    $nomCommercial = $form->getValue('MED_NOMCOMMERCIAL');
            $famCode = $form->getValue('FAM_CODE');
            $composition = $form->getValue('MED_COMPOSITION');
            $effets = $form->getValue('MED_EFFETS');
            $contreindic = $form->getValue('MED_CONTREINDIC');
            $prix = $form->getValue('MED_PRIXECHANTILLON');
            $Medicaments = new Application_Model_DbTable_Medicaments();
            $Medicaments->modifierMedicaments($id, $nomCommercial, $famCode, $composition, $effets, $contreindic, $prix);

            $this->_helper->redirector('index');
        } else {
            $form->populate($formData);
        }
    } else {
        $id = $this->_getParam('MED_DEPOTLEGAL', 0);
        if ($id > 0) {
            $Medicaments = new Application_Model_DbTable_Medicaments();
            $form->populate($Medicaments->obtenirMedicaments($id));
        }
    }
    }

    public function supprimerAction()
    {
        if ($this->getRequest()->isPost()) {
        $supprimer = $this->getRequest()->getPost('supprimer');
        if ($supprimer == 'Oui') {
            $id = $this->getRequest()->getPost('MED_DEPOTLEGAL');
            $Medicaments = new Application_Model_DbTable_Medicaments();
            $Medicaments->supprimerMedicaments($id);
        }
        $this->_helper->redirector('index');
        } 
	else {
        $id = $this->_getParam('MED_DEPOTLEGAL', 0);
        $Medicaments = new Application_Model_DbTable_Medicaments();
        $this->view->Medicaments = $Medicaments->obtenirMedicaments($id);
        }
    }


}







