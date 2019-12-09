<?php
namespace Relatorios\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;

class RelatoriosTable
{
    public static function relatorioGeral($adapter,$data_inicial,$data_final,$informacao,$ordem,$nlinhas)
    {
        if($data_inicial)
            $data_inicial = date('Y-m-d',  strtotime($data_inicial));
        else
            $data_inicial = date('1900-01-01');

        if($data_final)
            $data_final = date('Y-m-d',  strtotime($data_final));
        else
            $data_final = date('1900-01-01');    

        $sql = "CALL rel_RelatorioGeral_sp('" . $data_inicial . "','" . $data_final . "'," . $informacao . "," . $ordem . "," . $nlinhas . ")";

        $result = new ResultSet(); 

        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $result;
    }
    
    public static function consultarFuncionarios($adapter,$id = Null,$nome = Null)
    {
        $resultSet = new ResultSet();
        if($id != Null && $nome == Null)
            $sql = "select f.id, f.nome, f.funcao, DATE_FORMAT(f.data_nascimento, '%d/%m/%Y') as data_nascimento from funcionarios f inner join perfil p on p.id = f.perfil where vid = " . $id . " and p.id > (select ff.perfil from funcionarios ff where ff.id = " . $_SESSION['funcionario']->id . ")";
        else if($id == Null && $nome != Null)
            $sql = "select f.id, f.nome, f.funcao, DATE_FORMAT(f.data_nascimento, '%d/%m/%Y') as data_nascimento from funcionarios f inner join perfil p on p.id = f.perfil where f.nome like '%" . $nome . "%' and p.id > (select ff.perfil from funcionarios ff where ff.id = " . $_SESSION['funcionario']->id . ")";
        else if($id != Null && $nome != Null)
            $sql = "select f.id, f.nome, f.funcao, DATE_FORMAT(f.data_nascimento, '%d/%m/%Y') as data_nascimento from funcionarios f inner join perfil p on p.id = f.perfil where f.nome like '%" . $nome . "%' and f.id = " . $id . " and p.id > (select ff.perfil from funcionarios ff where ff.id = " . $_SESSION['funcionario']->id . ")";
        else
            $sql = "select f.id, f.nome, f.funcao, DATE_FORMAT(f.data_nascimento, '%d/%m/%Y') as data_nascimento from funcionarios f inner join perfil p on p.id = f.perfil where p.id > (select ff.perfil from funcionarios ff where ff.id = " . $_SESSION['funcionario']->id . ")";

        $resultSet = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $resultSet;
    }
}