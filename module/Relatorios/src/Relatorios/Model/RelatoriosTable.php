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
}