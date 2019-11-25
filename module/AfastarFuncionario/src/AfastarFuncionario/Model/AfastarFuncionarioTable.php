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
            $sql = "select id, nome, funcao, DATE_FORMAT(data_nascimento, '%d/%m/%Y') as data_nascimento from funcionarios where id = " . $id . " and id <> " . $_SESSION['funcionario']->id;
        else if($id == Null && $nome != Null)
            $sql = "select id, nome, funcao, DATE_FORMAT(data_nascimento, '%d/%m/%Y') as data_nascimento from funcionarios where nome like '%" . $nome . "%' and id <> " . $_SESSION['funcionario']->id;
        else if($id != Null && $nome != Null)
            $sql = "select id, nome, funcao, DATE_FORMAT(data_nascimento, '%d/%m/%Y') as data_nascimento from funcionarios where nome like '%" . $nome . "%' and id = " . $id . " and id <> " . $_SESSION['funcionario']->id;
        else
            $sql = "select id, nome, funcao, DATE_FORMAT(data_nascimento, '%d/%m/%Y') as data_nascimento from funcionarios where id <> " . $_SESSION['funcionario']->id;            

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

    public static function buscarTodos($adapter)
    {
        $sql = "select a.id,DATE_FORMAT(data_ini, '%d/%m/%Y') as data,f.nome,ta.descricao as tipo from funcionarios_afastados a inner join funcionarios f on f.id = a.funcionario_id inner join tipo_afastamento ta on a.tipo = ta.id";

        $resultSet = new ResultSet();

        $resultSet = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $resultSet;
    } 
}