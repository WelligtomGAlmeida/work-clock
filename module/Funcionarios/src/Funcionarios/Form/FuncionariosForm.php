<?php
namespace Funcionarios\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class FuncionariosForm extends Form
{
    public function __construct($name = null)
    {
        // Nos iremos ignorar o nome passado
        parent::__construct('funcionarios');
        
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'nome',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nome',
            ),
        ));
        $this->add(array(
            'name' => 'sexo',
            'type' => 'Select',
            'options' => array(
                'label' => 'Sexo',
                'options' => array('0' => '','M' => 'Masculino','F' => 'Feminino')
            ),
        ));
        $this->add(array(
            'name' => 'data_nascimento',
            'type' => 'Date',
            'options' => array(
                'label' => 'Nasc',
            ),
        ));
        $this->add(array(
            'name' => 'rg',
            'type' => 'Text',
            'options' => array(
                'label' => 'RG',
            ),
        ));
        $this->add(array(
            'name' => 'cpf',
            'type' => 'Text',
            'options' => array(
                'label' => 'CPF',
            ),
        ));
        $this->add(array(
            'name' => 'pis_nis',
            'type' => 'Text',
            'options' => array(
                'label' => 'PIS/NIS',
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
            'name' => 'salario',
            'type' => 'Text',
            'options' => array(
                'label' => 'Salário',
            ),
        ));
        $this->add(array(
            'name' => 'sindicato',
            'type' => 'Radio',
            'options' => array(
                'label' => 'Paga Sindicato?',
                'options' => array('1' => 'Sim','0' => 'Não')
            ),
        ));
        $this->add(array(
            'name' => 'funcao',
            'type' => 'Text',
            'options' => array(
                'label' => 'Função',
            ),
        ));
        $this->add(array(
            'name' => 'perfil',
            'type' => 'Select',
            'options' => array(
                'label' => 'Perfil',
                'options' => array('1' => 'Administrador','2' => 'Gerente','3' => 'Funcionário Comum')
            ),
        ));
        $this->add(array(
            'name' => 'user_name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nome de Usuário',
            ),
        ));
        $this->add(array(
            'name' => 'senha',
            'type' => 'Text',
            'options' => array(
                'label' => 'Senha',
            ),
        ));
        $this->add(array(
            'name' => 'data_admissao',
            'type' => 'Date',
            'options' => array(
                'label' => 'Data de Admissao',
            ),
        ));
        $this->add(array(
            'name' => 'empresa_id',
            'type' => 'Text',
            'options' => array(
                'label' => 'Empresa(tmp)',
            ),
        ));
        $this->add(array(
            'name' => 'cep',
            'type' => 'Text',
            'options' => array(
                'label' => 'CEP',
            ),
        ));
        $this->add(array(
            'name' => 'cidade',
            'type' => 'Text',
            'options' => array(
                'label' => 'Cidade',
            ),
        ));
        $this->add(array(
            'name' => 'uf',
            'type' => 'Text',
            'options' => array(
                'label' => 'UF',
            ),
        ));
        $this->add(array(
            'name' => 'logradouro',
            'type' => 'Text',
            'options' => array(
                'label' => 'Logradouro',
            ),
        ));
        $this->add(array(
            'name' => 'numero',
            'type' => 'Text',
            'options' => array(
                'label' => 'Número',
            ),
        ));
        $this->add(array(
            'name' => 'bairro',
            'type' => 'Text',
            'options' => array(
                'label' => 'Bairro',
            ),
        ));
        $this->add(array(
            'name' => 'complemento',
            'type' => 'Text',
            'options' => array(
                'label' => 'Complemento',
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