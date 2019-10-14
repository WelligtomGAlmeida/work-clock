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
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'cnpj',
            'type' => 'Text',
            'options' => array(
                'label' => 'CNPJ',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'telefone_fixo',
            'type' => 'Text',
            'options' => array(
                'label' => 'Telefone Fixo',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'telefone_celular_1',
            'type' => 'Text',
            'options' => array(
                'label' => 'Celular 1',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'telefone_celular_2',
            'type' => 'Text',
            'options' => array(
                'label' => 'Celular 2',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'type' => 'Text',
            'options' => array(
                'label' => 'E-mail',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'data_cadastro',
            'type' => 'Date',
            'options' => array(
                'label' => 'Data de Cadastro',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'cep',
            'type' => 'Text',
            'options' => array(
                'label' => 'CEP',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'cidade',
            'type' => 'Text',
            'options' => array(
                'label' => 'Cidade',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'uf',
            'type' => 'Text',
            'options' => array(
                'label' => 'UF',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'logradouro',
            'type' => 'Text',
            'options' => array(
                'label' => 'Logradouro',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'numero',
            'type' => 'Text',
            'options' => array(
                'label' => 'Número',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'bairro',
            'type' => 'Text',
            'options' => array(
                'label' => 'Bairro',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'complemento',
            'type' => 'Text',
            'options' => array(
                'label' => 'Complemento',
            ),
            'attributes' => array(
                'class' => 'form-control',
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