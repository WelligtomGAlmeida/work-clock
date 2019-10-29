<?php
namespace Login\Form;

use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct($name = null)
    {
        // Nos iremos ignorar o nome passado
        parent::__construct('login');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'user_name',
            'type' => 'Text',
            'attributes' => array(
                'style' => 'width:250px;height:35px;border:none;',
                'placeholder' => 'Usuário',
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name'  => 'senha',
            'type'  => 'Password',
            'attributes' => array(
                'style' => 'width:250px;height:35px;border:none;',
                'placeholder' => 'Senha',
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-secondary btn-lg',
                'style' => 'background-color:#32CD32;border:none;width:250px;margin:30px;',
            ),
        ));
    }
}