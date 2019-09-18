<?php
namespace Empresas\Form;

use Zend\Form\Form;

class EmpresasForm extends Form
{
    public function __construct($name = null)
    {
        // Nos iremos ignorar o nome passado
        parent::__construct('empresas');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'razao_social',
            'type' => 'Text',
            'options' => array(
                'label' => 'Razão Social',
            ),
        ));
        $this->add(array(
            'name' => 'cnpj',
            'type' => 'Text',
            'options' => array(
                'label' => 'CNPJ',
            ),
        ));
        $this->add(array(
            'name' => 'telefone_fixo',
            'type' => 'Text',
            'options' => array(
                'label' => 'Telefone Fixo',
            ),
        ));
        $this->add(array(
            'name' => 'telefone_celular_1',
            'type' => 'Text',
            'options' => array(
                'label' => 'Celular 1',
            ),
        ));
        $this->add(array(
            'name' => 'telefone_celular_2',
            'type' => 'Text',
            'options' => array(
                'label' => 'Celular 2',
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'type' => 'Text',
            'options' => array(
                'label' => 'E-mail',
            ),
        ));
        $this->add(array(
            'name' => 'data_cadastro',
            'type' => 'Date',
            'options' => array(
                'label' => 'Data de Cadastro',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}