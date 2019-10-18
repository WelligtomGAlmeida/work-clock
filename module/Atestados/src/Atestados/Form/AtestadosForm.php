<?php
namespace Atestados\Form;

use Zend\Form\Form;

class AtestadosForm extends Form
{
    public function __construct($name = null)
    {
        // Nos iremos ignorar o nome passado
        parent::__construct('atestados');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'funcionario_id',
            'type' => 'Hidden',
            'options' => array(
                'label' => 'Funcionário *',
            ),
        ));
        $this->add(array(
            'name' => 'data',
            'type' => 'Date',
            'options' => array(
                'label' => 'Data *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),

        ));
        $this->add(array(
            'name' => 'horas_abonadas',
            'type' => 'Text',
            'options' => array(
                'label' => 'Horas Abonadas *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'motivo',
            'type' => 'TextArea',
            'options' => array(
                'label' => 'Motivo *',
            ),
            'attributes' => array(
                'style' => 'resize: none; width: 500px;height:150px;',
                'class' => 'form-control'
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