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
            'attributes' => array(
                'class' => 'form-control',
                'style' => 'width:100%;',
                'id' => 'razao_social',
                'maxlength' => '100',
            ),
        ));
        $this->add(array(
            'name' => 'cnpj',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'style' => 'width: 100',
                'id' => 'cnpj',
                'maxlength' => '18',
            ),
        ));
        $this->add(array(
            'name' => 'telefone_fixo',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'telefone_fixo',
                'maxlength' => '14',
            ),
        ));
        $this->add(array(
            'name' => 'telefone_celular_1',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'telefone_celular_1',
                'maxlength' => '15',
            ),
        ));
        $this->add(array(
            'name' => 'telefone_celular_2',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'telefone_celular_2',
                'maxlength' => '15',
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'email',
                'maxlength' => '50',
            ),
        ));
        $this->add(array(
            'name' => 'data_cadastro',
            'type' => 'Hidden',
            'options' => array(
                'label' => 'Data de Cadastro',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'data_cadastro',
            ),
        ));
        $this->add(array(
            'name' => 'cep',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'cep',
                'maxlength' => '9',
            ),
        ));
        $this->add(array(
            'name' => 'cidade',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'cidade',
                'maxlength' => '50',
            ),
        ));
        $this->add(array(
            'name' => 'uf',
            'type' => 'Select',
            'options' => array(
                'options' => array( '' => 'Selecione o estado',
                                    'AC' => 'Acre',
                                    'AL' => 'Alagoas',
                                    'AP' => 'Amapá',
                                    'AM' => 'Amazonas',
                                    'BA' => 'Bahia',
                                    'CE' => 'Ceará',
                                    'DF' => 'Distrito Federal',
                                    'ES' => 'Espírito Santo',
                                    'GO' => 'Goiás',
                                    'MA' => 'Maranhão',
                                    'MT' => 'Mato Grosso',
                                    'MS' => 'Mato Grosso do Sul',
                                    'MG' => 'Minas Gerais',
                                    'PA' => 'Pará',
                                    'PB' => 'Paraíba',
                                    'PR' => 'Paraná',
                                    'PE' => 'Pernambuco',
                                    'PI' => 'Piauí',
                                    'RJ' => 'Rio de Janeiro',
                                    'RN' => 'Rio Grande do Norte',
                                    'RS' => 'Rio Grande do Sul',
                                    'RO' => 'Rondônia',
                                    'RR' => 'Roraima',
                                    'SC' => 'Santa Catarina',
                                    'SP' => 'São Paulo',
                                    'SE' => 'Sergipe',
                                    'TO' => 'Tocantins'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'uf',
            ),
        ));
        $this->add(array(
            'name' => 'logradouro',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'logradouro',
                'maxlength' => '70',
            ),
        ));
        $this->add(array(
            'name' => 'numero',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'numero',
                'maxlength' => '10',
            ),
        ));
        $this->add(array(
            'name' => 'bairro',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'bairro',
                'maxlength' => '50',
            ),
        ));
        $this->add(array(
            'name' => 'complemento',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'complemento',
                'maxlength' => '20',
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