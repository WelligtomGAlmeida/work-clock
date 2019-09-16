<?php
namespace Empresa\Model;

use Zend\Db\TableGateway\TableGateway;

class EmpresaTable
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

    public function getEmpresa($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveEmpresa(Empresa $empresa)
    {
        $data = array(
            'nome' => $empresa->nome,
        );

        $id = (int) $empresa->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getEmpresa($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Empresa id does not exist');
            }
        }
    }

    public function deleteEmpresa($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}