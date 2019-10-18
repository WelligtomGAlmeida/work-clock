<?php
namespace VariaveisEmpresa\Form;

use Zend\Form\Form;
use Zend\Form\Element;

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
            'name' => 'empresa_id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'ent_1',
            'type' => 'Text',
            'options' => array(
                'label' => 'Entrada *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'sai_1',
            'type' => 'Text',
            'options' => array(
                'label' => 'Intervalo *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'ent_2',
            'type' => 'Text',
            'options' => array(
                'label' => 'Retorno *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'sai_2',
            'type' => 'Text',
            'options' => array(
                'label' => 'Saída *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'salario_padrao',
            'type' => 'Text',
            'options' => array(
                'label' => 'Salário Padrão *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'valor_hora_extra',
            'type' => 'Text',
            'options' => array(
                'label' => 'Valor da Hora Extra *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'horas_semanais',
            'type' => 'Text',
            'options' => array(
                'label' => 'Horas Semanais *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'ent_sab_1',
            'type' => 'Text',
            'options' => array(
                'label' => 'Entrada',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'sai_sab_1',
            'type' => 'Text',
            'options' => array(
                'label' => 'Intervalo',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'ent_sab_2',
            'type' => 'Text',
            'options' => array(
                'label' => 'Retorno',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'sai_sab_2',
            'type' => 'Text',
            'options' => array(
                'label' => 'Saída',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        
        $this->add(array(
            'name' => 'valor_sindicato',
            'type' => 'Text',
            'options' => array(
                'label' => 'Valor do Sindicato *',
            ),
            'attributes' => array(
                'class' => 'form-control'
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