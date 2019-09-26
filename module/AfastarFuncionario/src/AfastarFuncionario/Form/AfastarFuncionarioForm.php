<?php
namespace AfastarFuncionario\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class AfastarFuncionarioForm extends Form
{
    public function __construct($name = null)
    {
        // Nos iremos ignorar o nome passado
        parent::__construct('afastarFuncionario');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'funcionario_id',
            'type' => 'Text',
            'options' => array(
                'label' => 'Funcionario(temp)',
            ),
        ));
        $this->add(array(
            'name' => 'data_ini',
            'type' => 'Date',
            'options' => array(
                'label' => 'Data de Início',
            ),
        ));
        $this->add(array(
            'name' => 'data_fim',
            'type' => 'Date',
            'options' => array(
                'label' => 'Data de Fim',
            ),
        ));
        $this->add(array(
            'name' => 'tipo',
            'type' => 'Select',
            'options' => array(
                'label' => 'Tipo',
                'options' => array('1' => 'Tipo 1','2' => 'Tipo 1','3' => 'Tipo 3')
            ),
        ));
        $this->add(array(
            'name' => 'observacao',
            'type' => 'Text',
            'options' => array(
                'label' => 'Observação',
            ),
        ));
        $this->add(array(
            'name' => 'motivo',
            'type' => 'Text',
            'options' => array(
                'label' => 'Motivo',
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