<?php
namespace Login\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Login
{
    public $user_name;
    public $senha;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->user_name = (!empty($data['user_name'])) ? $data['user_name'] : null;
        $this->senha = (!empty($data['senha'])) ? $data['senha'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'user_name',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                'isEmpty' => 'É obrigatório Informar o Usuário'
                            )
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'senha',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                'isEmpty' => 'É obrigatório informar a Senha'
                            )
                        ),
                    ),
                ),
            )));                                                                         

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}