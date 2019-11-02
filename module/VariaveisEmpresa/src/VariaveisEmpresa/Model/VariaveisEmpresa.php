<?php
namespace VariaveisEmpresa\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class VariaveisEmpresa
{
    public $id;
    public $ent_1;
    public $sai_1;
    public $ent_2;
    public $sai_2;
    public $horas_semanais;
    public $ent_sab_1;
    public $sai_sab_1;
    public $ent_sab_2;
    public $sai_sab_2;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->ent_1 = (!empty($data['ent_1'])) ? $data['ent_1'] : null;
        $this->sai_1 = (!empty($data['sai_1'])) ? $data['sai_1'] : null;
        $this->ent_2 = (!empty($data['ent_2'])) ? $data['ent_2'] : null;
        $this->sai_2 = (!empty($data['sai_2'])) ? $data['sai_2'] : null;
        $this->horas_semanais = (!empty($data['horas_semanais'])) ? $data['horas_semanais'] : null;
        $this->ent_sab_1 = (!empty($data['ent_sab_1'])) ? $data['ent_sab_1'] : null;
        $this->sai_sab_1 = (!empty($data['sai_sab_1'])) ? $data['sai_sab_1'] : null;
        $this->ent_sab_2 = (!empty($data['ent_sab_2'])) ? $data['ent_sab_2'] : null;
        $this->sai_sab_2 = (!empty($data['sai_sab_2'])) ? $data['sai_sab_2'] : null;
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

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}