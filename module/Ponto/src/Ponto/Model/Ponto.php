<?php
namespace Ponto\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Ponto
{
    public $id;
    public $funcionario_id;
    public $hora_entrada;
    public $hora_saida;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->funcionario_id = (!empty($data['funcionario_id'])) ? $data['funcionario_id'] : null;
        $this->hora_entrada = (!empty($data['hora_entrada'])) ? $data['hora_entrada'] : null;
        $this->hora_saida = (!empty($data['hora_saida'])) ? $data['hora_saida'] : null;
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
                'name'     => 'id',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'funcionario_id',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'hora_entrada',
                'required' => false,
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'hora_saida',
                'required' => false,
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