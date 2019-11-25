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
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'data_ini',
            'type' => 'Date',
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'data_fim',
            'type' => 'Date',
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'tipo',
            'type' => 'Select',
            'options' => array(
                'options' => array('1' => 'Demissão','2' => 'Férias','3' => 'Licenca Maternidade','4' => 'Licenca Paternidade','5' => 'Licença para tratamento de saúde')
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'observacao',
            'type' => 'TextArea',
            'attributes' => array(
                'style' => 'resize: none; width: 500px;height:150px;',
                'class' => 'form-control',
                'id' => 'observacao',
                'maxlength' => '200',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-success btn-lg col-md-2 '
            ),
        ));
    }
}