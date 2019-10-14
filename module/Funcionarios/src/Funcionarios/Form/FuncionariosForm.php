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
                'label' => 'Nome *',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'sexo',
            'type' => 'Select',
            'options' => array(
                'label' => 'Sexo *',
                'options' => array('0' => '','M' => 'Masculino','F' => 'Feminino')
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'data_nascimento',
            'type' => 'Date',
            'options' => array(
                'label' => 'Data de Nascimento *',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'data_cadastro',
            'type' => 'Hidden',
            'options' => array(
                'label' => 'Data de Cadastro *',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'rg',
            'type' => 'Text',
            'options' => array(
                'label' => 'RG *',
            ),
            'attributes' => array(
                'class' => 'form-control rg',
            ),
        ));
        $this->add(array(
            'name' => 'cpf',
            'type' => 'Text',
            'options' => array(
                'label' => 'CPF *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'pis_nis',
            'type' => 'Text',
            'options' => array(
                'label' => 'PIS/NIS *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'telefone_fixo',
            'type' => 'Text',
            'options' => array(
                'label' => 'Telefone Fixo',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'telefone_celular_1',
            'type' => 'Text',
            'options' => array(
                'label' => 'Celular 1 *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'telefone_celular_2',
            'type' => 'Text',
            'options' => array(
                'label' => 'Celular 2',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'type' => 'Text',
            'options' => array(
                'label' => 'E-mail',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'salario',
            'type' => 'Text',
            'options' => array(
                'label' => 'Salário *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'funcao',
            'type' => 'Text',
            'options' => array(
                'label' => 'Função *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'perfil',
            'type' => 'Select',
            'options' => array(
                'label' => 'Perfil *',
                'options' => array('1' => 'Administrador','2' => 'Gerente','3' => 'Funcionário Comum')
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'user_name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nome de Usuário *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'senha',
            'type' => 'password',
            'options' => array(
                'label' => 'Senha *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'data_admissao',
            'type' => 'Date',
            'options' => array(
                'label' => 'Data de Admissao *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'cep',
            'type' => 'Text',
            'options' => array(
                'label' => 'CEP *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'cidade',
            'type' => 'Text',
            'options' => array(
                'label' => 'Cidade *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'uf',
            'type' => 'Text',
            'options' => array(
                'label' => 'UF *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'logradouro',
            'type' => 'Text',
            'options' => array(
                'label' => 'Logradouro *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'numero',
            'type' => 'Text',
            'options' => array(
                'label' => 'Número *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'bairro',
            'type' => 'Text',
            'options' => array(
                'label' => 'Bairro *',
            ),
            'attributes' => array(
                'class' => 'form-control'
            ),
        ));
        $this->add(array(
            'name' => 'complemento',
            'type' => 'Text',
            'options' => array(
                'label' => 'Complemento',
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
                'class' => 'btn btn-success btn-lg col-md-2 '
            ),
        ));
    }
}