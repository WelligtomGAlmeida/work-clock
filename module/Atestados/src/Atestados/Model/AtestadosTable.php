<?php
namespace Atestados\Model;

use Zend\Authentication\Storage\Session;
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
        $sql = "select fa.id,f.nome,DATE_FORMAT(data, '%d/%m/%Y') as data,horas_abonadas,motivo from atestados fa inner join funcionarios f on fa.funcionario_id = f.id where fa.id = " . $id;

        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $result->current();
    }

    public static function buscarTodos($adapter)
    {
        $sql = "select a.id,DATE_FORMAT(data, '%d/%m/%Y') as data,f.nome,horas_abonadas from atestados a inner join funcionarios f on f.id = a.funcionario_id";

        $resultSet = new ResultSet();

        $resultSet = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $resultSet;
    }
}