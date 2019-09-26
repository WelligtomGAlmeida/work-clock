<?php
namespace AfastarFuncionario\Model;

use Zend\Db\TableGateway\TableGateway;

class AfastarFuncionarioTable
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

    public function getAfastarFuncionario($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi possível encontrar a afastamento com id $id");
        }
        return $row;
    }

    public function saveAfastarFuncionario(AfastarFuncionario $afastarFuncionario)
    {
        $data = array(
            'funcionario_id' => $afastarFuncionario->funcionario_id,
            'data_ini' => $afastarFuncionario->data_ini,
            'data_fim' => $afastarFuncionario->data_fim,
            'tipo' => $afastarFuncionario->tipo,
            'observacao' => $afastarFuncionario->observacao,
            'motivo' => $afastarFuncionario->motivo
        );

        $id = (int) $afastarFuncionario->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getAfastarFuncionario($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Este afastamento não existe');
            }
        }
    }

    public function deleteAfastarFuncionario($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}