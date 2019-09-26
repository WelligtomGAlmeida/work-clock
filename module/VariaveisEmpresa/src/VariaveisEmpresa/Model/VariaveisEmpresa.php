<?php
namespace VariaveisEmpresa\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class VariaveisEmpresa
{
    public $id;
    public $empresa_id;
    public $ent_1;
    public $sai_1;
    public $ent_2;
    public $sai_2;
    public $salario_padrao;
    public $valor_hora_extra;
    public $trabalho_sabado;
    public $horas_semanais;
    public $ent_sab_1;
    public $sai_sab_1;
    public $ent_sab_2;
    public $sai_sab_2;
    public $valor_sindicato;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->empresa_id = (!empty($data['empresa_id'])) ? $data['empresa_id'] : null;
        $this->ent_1 = (!empty($data['ent_1'])) ? $data['ent_1'] : null;
        $this->sai_1 = (!empty($data['sai_1'])) ? $data['sai_1'] : null;
        $this->ent_2 = (!empty($data['ent_2'])) ? $data['ent_2'] : null;
        $this->sai_2 = (!empty($data['sai_2'])) ? $data['sai_2'] : null;
        $this->salario_padrao = (!empty($data['salario_padrao'])) ? $data['salario_padrao'] : null;
        $this->valor_hora_extra = (!empty($data['valor_hora_extra'])) ? $data['valor_hora_extra'] : null;
        $this->trabalho_sabado = (!empty($data['trabalho_sabado'])) ? $data['trabalho_sabado'] : null;
        $this->horas_semanais = (!empty($data['horas_semanais'])) ? $data['horas_semanais'] : null;
        $this->ent_sab_1 = (!empty($data['ent_sab_1'])) ? $data['ent_sab_1'] : null;
        $this->sai_sab_1 = (!empty($data['sai_sab_1'])) ? $data['sai_sab_1'] : null;
        $this->ent_sab_2 = (!empty($data['ent_sab_2'])) ? $data['ent_sab_2'] : null;
        $this->sai_sab_2 = (!empty($data['sai_sab_2'])) ? $data['sai_sab_2'] : null;
        $this->valor_sindicato = (!empty($data['valor_sindicato'])) ? $data['valor_sindicato'] : null;
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
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'empresa_id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'ent_1',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'sai_1',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'ent_2',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'sai_2',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'salario_padrao',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 4,
                            'max'      => 8,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'valor_hora_extra',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name'     => 'trabalho_sabado',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name'     => 'horas_semanais',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name'     => 'ent_sab_1',
                'required' => false,
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'sai_sab_1',
                'required' => false,
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'ent_sab_2',
                'required' => false,
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'sai_sab_2',
                'required' => false,
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'valor_sindicato',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 4,
                            'max'      => 8,
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