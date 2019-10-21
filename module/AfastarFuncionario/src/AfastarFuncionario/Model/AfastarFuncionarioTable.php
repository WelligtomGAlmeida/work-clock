<?php
namespace AfastarFuncionario\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;

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
        $sql = " select fa.id,f.nome,data_ini,data_fim,tipo,observacao from funcionarios_afastados fa inner join funcionarios f on fa.funcionario_id = f.id where fa.id = " . $id;

        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $result->current();
    }

}