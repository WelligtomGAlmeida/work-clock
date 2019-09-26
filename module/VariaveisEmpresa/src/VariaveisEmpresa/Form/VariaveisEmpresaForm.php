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
            'type' => 'Time',
            'options' => array(
                'label' => 'Entrada 1',
            ),
        ));
        $this->add(array(
            'name' => 'sai_1',
            'type' => 'Time',
            'options' => array(
                'label' => 'Saída 1',
            ),
        ));
        $this->add(array(
            'name' => 'ent_2',
            'type' => 'Time',
            'options' => array(
                'label' => 'Entrada 2',
            ),
        ));
        $this->add(array(
            'name' => 'sai_2',
            'type' => 'Time',
            'options' => array(
                'label' => 'Saída 2',
            ),
        ));
        $this->add(array(
            'name' => 'salario_padrao',
            'type' => 'Text',
            'options' => array(
                'label' => 'Salário Padrão',
            ),
        ));
        $this->add(array(
            'name' => 'valor_hora_extra',
            'type' => 'Text',
            'options' => array(
                'label' => 'Valor da Hora Extra',
            ),
        ));
        $this->add(array(
            'name' => 'trabalho_sabado',
            'type' => 'Radio',
            'options' => array(
                'label' => 'Trabalha no Sábado?',
                'options' => array(1 => 'Sim', 0 => 'Não')
            ),
        ));
        $this->add(array(
            'name' => 'horas_semanais',
            'type' => 'Text',
            'options' => array(
                'label' => 'Horas Semanais',
            ),
        ));
        $this->add(array(
            'name' => 'ent_sab_1',
            'type' => 'Time',
            'options' => array(
                'label' => 'Sábado Entrada 1',
            ),
        ));
        $this->add(array(
            'name' => 'sai_sab_1',
            'type' => 'Time',
            'options' => array(
                'label' => 'Sábado Saída 1',
            ),
        ));
        $this->add(array(
            'name' => 'ent_sab_2',
            'type' => 'Time',
            'options' => array(
                'label' => 'Sábado Entrada 2',
            ),
        ));
        $this->add(array(
            'name' => 'sai_sab_2',
            'type' => 'Time',
            'options' => array(
                'label' => 'Sábado Saída 2',
            ),
        ));
        $this->add(array(
            'name' => 'valor_sindicato',
            'type' => 'Text',
            'options' => array(
                'label' => 'Valor do Sindicato',
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