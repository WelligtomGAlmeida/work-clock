<?php
namespace VariaveisEmpresa\Form;

use Zend\Form\Form;

class VariaveisEmpresaForm extends Form
{
    public function __construct($name = null)
    {
        // Nos iremos ignorar o nome passado
        parent::__construct('variaveisEmpresa');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'ent_1',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control hora',
                'id' => 'ent_1',
            ),
        ));
        $this->add(array(
            'name' => 'sai_1',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control hora',
                'id' => 'sai_1',
            ),
        ));
        $this->add(array(
            'name' => 'ent_2',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control hora',
                'id' => 'ent_2',
            ),
        ));
        $this->add(array(
            'name' => 'sai_2',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control hora',
                'id' => 'sai_2',
            ),
        ));
        $this->add(array(
            'name' => 'horas_semanais',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'horas_semanais',
            ),
        ));
        $this->add(array(
            'name' => 'ent_sab_1',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control hora',
                'id' => 'ent_sab_1',
            ),
        ));
        $this->add(array(
            'name' => 'sai_sab_1',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control hora',
                'id' => 'sai_sab_1',
            ),
        ));
        $this->add(array(
            'name' => 'ent_sab_2',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control hora',
                'id' => 'ent_sab_2',
            ),
        ));
        $this->add(array(
            'name' => 'sai_sab_2',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control hora',
                'id' => 'sai_sab_2',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-success btn-lg active col-md-2',
                
            ),
        ));
    }
}