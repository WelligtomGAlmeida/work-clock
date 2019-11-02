<?php
namespace VariaveisEmpresa\Model;

use Zend\Db\TableGateway\TableGateway;

class VariaveisEmpresaTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getVariaveisEmpresa($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi possível encontrar a empresa com id $id");
        }
        return $row;
    }

    public function saveVariaveisEmpresa(VariaveisEmpresa $variaveisEmpresa)
    {
        $data = array(
            'ent_1' => $variaveisEmpresa->ent_1,
            'sai_1' => $variaveisEmpresa->sai_1,
            'ent_2' => $variaveisEmpresa->ent_2,
            'sai_2' => $variaveisEmpresa->sai_2,
            'horas_semanais' => $variaveisEmpresa->horas_semanais,
            'ent_sab_1' => $variaveisEmpresa->ent_sab_1,
            'sai_sab_1' => $variaveisEmpresa->sai_sab_1,
            'ent_sab_2' => $variaveisEmpresa->ent_sab_2,
            'sai_sab_2' => $variaveisEmpresa->sai_sab_2,
        );

        $id = (int) $variaveisEmpresa->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getVariaveisEmpresa($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Esta configuração não existe');
            }
        }
    }
}