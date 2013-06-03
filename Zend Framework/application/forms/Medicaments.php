<?php

class Application_Form_Medicaments extends Zend_Form
{

    public function init()
    {
	//Nom
        $this->setName('Mdedicament');
        $id = new Zend_Form_Element_Hidden('MED_DEPOTLEGAL');
        $id->addFilter('Int');

        $nomCommercial = new Zend_Form_Element_Text('MED_NOMCOMMERCIAL');
        $nomCommercial->setLabel('Nom Commercial')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $famCode = new Zend_Form_Element_Text('FAM_CODE');
        $famCode->setLabel('Code Famille')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');

        $composition = new Zend_Form_Element_Text('MED_COMPOSITION');
        $composition->setLabel('Composition')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        $effets = new Zend_Form_Element_Text('MED_EFFETS');
        $effets->setLabel('Effets')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        $contreindic = new Zend_Form_Element_Text('MED_CONTREINDIC');
        $contreindic->setLabel('Contre Indication')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        $prix = new Zend_Form_Element_Text('MED_PRIXECHANTILLON');
        $prix->setLabel('Prix Echantillon')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');


        $envoyer = new Zend_Form_Element_Submit('envoyer');
        $envoyer->setAttrib('MED_DEPOTLEGAL', 'boutonenvoyer');

        $this->addElements(array($id, $nomCommercial, $famCode, $composition, $effets, $contreindic, $prix, $envoyer));
    }
}
