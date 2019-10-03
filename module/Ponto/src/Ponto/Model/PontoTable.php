<?php
namespace Ponto\Model;

use Zend\Db\TableGateway\TableGateway;

class PontoTable
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

    public function getPonto($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi possível encontrar o ponto com id $id");
        }
        return $row;
    }

    public function savePonto(Ponto $ponto)
    {
        $data = array(
            'funcionario_id' => $ponto->funcionario_id,
            'hora_entrada' => $ponto->hora_entrada,
            'hora_saida' => $ponto->hora_saida
        );

        $id = (int) $ponto->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getPonto($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Este ponto não existe');
            }
        }
    }

    public function deletePonto($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}