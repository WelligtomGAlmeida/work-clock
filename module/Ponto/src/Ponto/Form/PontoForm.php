<?php
namespace Ponto\Form;

use Zend\Form\Form;

class PontoForm extends Form
{
    public function __construct($name = null)
    {
        // Nos iremos ignorar o nome passado
        parent::__construct('ponto');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'funcionario_id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'hora_entrada',
            'type' => 'Hidden',
            'id' => 'hora_entrada',
        ));
        $this->add(array(
            'name' => 'hora_saida',
            'type' => 'Hidden',
            'id' => 'hora_saida',
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-secondary btn-lg',
                'style' => 'background-color:#32CD32;border:none;',
                'onclick' => 'enviar()'
            ),
        ));
    }
}