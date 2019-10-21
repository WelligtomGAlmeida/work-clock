<?php
namespace Atestados\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class AtestadosTable
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

    public function getAtestados($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi possível encontrar a empresa com id $id");
        }
        return $row;
    }

    public function saveAtestados(Atestados $atestados)
    {
        $data = array(
            'funcionario_id' => $atestados->funcionario_id,
            'data' => $atestados->data,
            'horas_abonadas' => $atestados->horas_abonadas,
            'motivo' => $atestados->motivo,
        );

        $id = (int) $atestados->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getAtestados($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Este atestado não existe');
            }
        }
    }

    public function deleteAtestados($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }

    public static function consultarFuncionarios($adapter,$id = Null,$nome = Null)
    {
        $resultSet = new ResultSet();
        if($id != Null && $nome == Null)
            $sql = "select * from funcionarios where id = " . $id;
        else if($id == Null && $nome != Null)
            $sql = "select * from funcionarios where nome like '%" . $nome . "%'";
        else if($id != Null && $nome != Null)
            $sql = "select * from funcionarios where nome like '%" . $nome . "%' and id = " . $id;
        else
            $sql = "select * from funcionarios";            

        $resultSet = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $resultSet;
    }

    public static function consultarFuncionario($adapter,$id)
    {
        $sql = "select * from funcionarios where id = " . $id;          

        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $result->current();
    }

    public static function buscarDados($adapter,$id)
    {
        $sql = "select fa.id,f.nome,data,horas_abonadas,motivo from atestados fa inner join funcionarios f on fa.funcionario_id = f.id where fa.id = " . $id;

        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $result->current();
    }
}